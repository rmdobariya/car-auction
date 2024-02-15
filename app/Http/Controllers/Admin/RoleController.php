<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Models\ModelHasRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-read|role-create|role-update|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update','store']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.role.index');
    }

    public function getRoleList(Request $request)
    {
        if ($request->ajax()) {
            $roles = DB::table('roles')->where('admin_id', \Auth::guard('admin')->user()->id)->select([
                'id',
                'name'
            ])->where('name', '!=', 'Super Admin')->get();
            return Datatables::of($roles)
                ->addColumn('action', function ($roles) {
                    $array = [
                        'id' => $roles->id,
                        'actions' => [
                            'edit' => route('admin.role.edit', [$roles->id]),
                            'delete' => '',
                            'edit_permission' => Auth::user()->can('role-update'),
                            'delete_permission' => Auth::user()->can('role-delete'),
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.role.index');
    }

    public function create()
    {
        $permissions = Permission::get()->unique('module_name');
        return view('admin.role.create', ['permissions' => $permissions]);
    }

    public function store(RoleStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ((int)$validated['edit_value'] === 0) {

            $role = Role::create([
                'name' => $request->input('name'),
                'guard_name' => 'admin',
                'admin_id' => \Auth::guard('admin')->user()->id,
            ]);
            $role->syncPermissions($request->input('permission'));
            return response()->json([
                'success' => true,
                'message' => trans('admin_string.record_add_successfully')
            ]);
        }
        $role = Role::find($validated['edit_value']);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return response()->json([
            'success' => true,
            'message' => trans('admin_string.record_update_successfully')
        ]);
    }

    public function edit(int $id)
    {
        $role = Role::find($id);
        $permissions = Permission::get()->unique('module_name');
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.role.edit',
            [
                "role" => $role,
                "permissions" => $permissions,
                "rolePermissions" => $rolePermissions,
            ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $count = ModelHasRole::where('role_id', $id)->count();
        if ($count > 0) {
            return response()->json([
                'message' => trans('admin_string.this_role_already_use_in')
            ], 422);
        }

        Role::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
}
