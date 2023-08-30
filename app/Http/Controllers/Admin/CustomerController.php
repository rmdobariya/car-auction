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
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-read|customer-create|customer-update|customer-delete', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        return view('admin.customer.index');
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::where('admin_id', \Auth::guard('admin')->user()->id)->where('id', '!=', 1)->get();
        return view('admin.customer.create',[
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
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole($validated['role_id']);
            return response()->json([
                'message' => 'Customer Add Successfully'
            ]);

        } else {
            $user = User::find($validated['edit_value']);
            $user->is_sub_admin = 1;
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->assignRole($validated['role_id']);
            return response()->json([
                'message' => 'Customer Update Successfully'
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
        $roles = \Spatie\Permission\Models\Role::where('admin_id', \Auth::guard('admin')->user()->id)->where('id', '!=', 1)->get();
        return view('admin.customer.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        User::where('id', $id)->delete();
        return response()->json([
            'message' => 'Customer Delete Successfully'
        ]);
    }

    public function multipleUserDelete(Request $request): JsonResponse
    {
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => 'Customer Delete Successfully'
        ]);
    }

    public function restoreCustomer($id): JsonResponse
    {
        DB::table('users')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Customer Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Customer Delete Successfully'
        ]);
    }

    public function getCustomerList(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::table('users')
                ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
                ->where('users.is_sub_admin', 1)
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
                                'edit' => route('admin.customer.edit', [$user->id]),
//                                'delete' => $user->id,
                                'status' => $user->status,
                            ]
                        ];
                    } else {
                        if (is_null($user->deleted_at)) {
                            $array = [
                                'id' => $user->id,
                                'actions' => [
                                    'edit' => route('admin.customer.edit', [$user->id]),
                                    'delete' => $user->id,
                                    'status' => $user->status,
                                ]
                            ];
                        } else {
                            $array = [
                                'id' => $user->id,
                                'actions' => [
                                    'hard-delete' => $user->id,
                                    'restore' => $user->id,
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
                    return $user->role_name;
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
            'message' => 'Status Change Successfully',
        ]);
    }
}
