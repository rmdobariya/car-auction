<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginCheck(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $request->email)->where('user_type', 'user')
            ->first();
        if (empty($user)) {
            return response()->json([
                'message' => 'Invalid Email',
            ], 401);
        } else if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Password',
            ], 401);
        } else {
            Auth::login($user);
            return response()->json([
                'message' => 'Login Successfully',
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->name;
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->contact_no = $request->phone;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type;
        $user->save();
        Auth::login($user);
        return response()->json([
            'message' => 'Register Successfully',
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
