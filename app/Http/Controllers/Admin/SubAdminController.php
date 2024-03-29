<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\PageStoreRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SubAdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sub-admin-read|sub-admin-create|sub-admin-update|sub-admin-delete|sub-admin-restore|sub-admin-status', ['only' => ['index']]);
        $this->middleware('permission:sub-admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sub-admin-update', ['only' => ['edit', 'update','store']]);
        $this->middleware('permission:sub-admin-delete', ['only' => ['destroy','hardDelete','multipleSubAdminDelete']]);
        $this->middleware('permission:sub-admin-restore', ['only' => ['restoreSubAdmin']]);
        $this->middleware('permission:sub-admin-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        $roles = \Spatie\Permission\Models\Role::where('admin_id', \Auth::guard('admin')->user()->id)->where('name', '!=', 'Admin')->get();
        return view('admin.sub-admin.index',[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::where('admin_id', \Auth::guard('admin')->user()->id)->where('name', '!=', 'Admin')->get();
        return view('admin.sub-admin.create', [
            'roles' => $roles
        ]);
    }

    public function store(CustomerStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $user = new User();
            $user->is_sub_admin = 1;
            $user->name = $request->first_name;
            $user->user_type = 'sub_admin';
            $user->is_corporate_seller = isset($request->is_corporate_seller) ? 1 : 0;
            $user->last_name = $request->last_name;
            $user->contact_no = $request->contact_no;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole($validated['role_id']);
            return response()->json([
                'message' => trans('admin_string.record_add_successfully')
            ]);

        } else {
            $user = User::find($validated['edit_value']);
            $user->is_sub_admin = 1;
            $user->name = $request->first_name;
            $user->user_type = 'sub_admin';
            $user->is_corporate_seller = isset($request->is_corporate_seller) ? 1 : 0;
            $user->last_name = $request->last_name;
            $user->contact_no = $request->contact_no;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            DB::table('model_has_roles')->where('model_id', $validated['edit_value'])->delete();
            $user->assignRole($validated['role_id']);
            return response()->json([
                'message' => trans('admin_string.record_update_successfully')
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::
        where('users.id', $id)
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.role_id')
            ->first();

        $roles = \Spatie\Permission\Models\Role::where('admin_id', \Auth::guard('admin')->user()->id)->where('name', '!=', 'Admin')->get();
        return view('admin.sub-admin.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        User::where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function multipleSubAdminDelete(Request $request): JsonResponse
    {
        $users = DB::table('users')->whereIn('id', $request->ids)->get();
        foreach ($users as $user) {
            if (!is_null($user->deleted_at)) {
                DB::table('users')->where('id', $user->id)->delete();
            } else {
                User::where('id', $user->id)->delete();
            }
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function restoreSubAdmin($id): JsonResponse
    {
        DB::table('users')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function getSubAdminList(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::table('users')
                ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
                ->where('users.is_sub_admin', 1)
                ->where('users.user_type', 'sub_admin')
                ->orderBy('id', 'desc')
                ->select('users.*', 'roles.name as role_name');
            if (!empty($request->status) && $request->status !== 'all') {
                $user->where('users.status', $request->status);
            }
            if (!empty($request->user_type) && $request->user_type !== 'all') {
                $user->where('users.user_type', $request->user_type);
            }
            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $user->whereNotNull('users.deleted_at');
                } else {
                    $user->whereNull('users.deleted_at');

                }
            }
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    if ((int)$user->id === 1) {
                        $array = [
                            'id' => $user->id,
                            'actions' => [
                                'edit' => route('admin.sub-admin.edit', [$user->id]),
//                                'delete' => $user->id,
                                'status' => $user->status,
                            ]
                        ];
                    } else {
                        if (is_null($user->deleted_at)) {
                            $array = [
                                'id' => $user->id,
                                'actions' => [
                                    'edit' => route('admin.sub-admin.edit', [$user->id]),
                                    'delete' => $user->id,
                                    'status' => $user->status,
                                    'edit_permission' => Auth::user()->can('sub-admin-update'),
                                    'delete_permission' => Auth::user()->can('sub-admin-delete'),
                                    'status_permission' => Auth::user()->can('sub-admin-status'),
                                ]
                            ];
                        } else {
                            $array = [
                                'id' => $user->id,
                                'actions' => [
                                    'hard-delete' => $user->id,
                                    'restore' => $user->id,
                                    'delete_permission' => Auth::user()->can('sub-admin-delete'),
                                    'restore_permission' => Auth::user()->can('sub-admin-restore'),
                                ]
                            ];
                        }

                    }

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($user) {
                    $array['status'] = $user->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('role', function ($user) {
                    return str_replace('_',' ',ucfirst($user->user_type));
                })
                ->addColumn('full_name', function ($user) {
                    return $user->name . ' ' . $user->last_name;
                })
                ->addColumn('check', function ($user) {
                    if ((int)$user->id === 1) {
                        return '';
                    } else {
                        return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value=' . $user->id . '>
                    </div>
                </td>';
                    }

                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        user::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }
}
