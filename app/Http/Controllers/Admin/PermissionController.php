<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionStoreRequest;
use App\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        $array = [
            'create' => 'create',
            'read'   => 'read',
            'update' => 'update',
            'delete' => 'delete',
            'restore' => 'restore',
            'status' => 'status',
            'detail' => 'detail',
        ];
        return view('admin.permission.create', ['array' => $array]);
    }

    public function store(PermissionStoreRequest $request)
    {
        $validated = $request->validated();
        $array = [
            'create' => 'create',
            'read'   => 'read',
            'update' => 'update',
            'delete' => 'delete',
            'restore' => 'restore',
            'status' => 'status',
            'detail' => 'detail',
        ];
        foreach ($array as $value) {
            if ($request->input($value)) {
                $permission[] = [
                    'module_name' => strtolower($validated['module_name']),
                    'guard_name'  => 'admin',
                    'name'        => str_replace(' ', '-', strtolower($validated['module_name'])) . '-' . $value,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
            }
        }
        Permission::insert($permission);
        return response()->json(['message' => trans('admin_string.record_add_successfully')], 200);
    }
}
