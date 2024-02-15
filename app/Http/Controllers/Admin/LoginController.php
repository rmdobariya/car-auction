<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    public function loginCheck(AdminLoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $admin = User::query()
            ->where('email', $validated['email'])
            ->first();
        if (empty($admin)) {
            return response()->json([
                'message' => 'Invalid Email',
            ], 401);
        } else if (!Hash::check($validated['password'], $admin->password)) {
            return response()->json([
                'message' => trans('admin_string.invalid_password'),
            ], 401);
        } else {
            Auth::guard('admin')->login($admin);
            return response()->json([
                'message' => trans('admin_string.login_successfully'),
            ]);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
