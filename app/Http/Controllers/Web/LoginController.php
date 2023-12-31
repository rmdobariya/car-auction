<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordStoreRequest;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Mail\Web\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function loginCheck(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $request->email)->whereIn('user_type', ['user', 'buyer', 'seller'])
            ->first();
        if (empty($user)) {
            return response()->json([
                'message' => trans('web_string.invalid_email'),
            ], 401);
        } else if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => trans('web_string.invalid_password'),
            ], 401);
        } else {
            Auth::login($user);
            return response()->json([
                'user_type' => $user->user_type,
                'message' => trans('web_string.login_successfully'),
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->full_name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->contact_no = $request->phone;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type;
        $user->save();
        Auth::login($user);
        return response()->json([
            'message' => trans('web_string.register_successfully'),
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('/');
    }

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            $token = Password::getRepository()->create($user);
            $array = [
                'name' => $user->name,
                'actionUrl' => route('reset-password', [$token]),
                'mail_title' => 'Please Click on the following link to reset your password.',
                'reset_password_subject' => 'Forgot Your Password',
                'main_title_text' => 'Forgot Your Password',
                'subject' => 'Password Reset',
            ];
            Mail::to($request->input('email'))->send(new ForgotPasswordMail($array));
            return response()->json([
                'message' => trans('web_string.please_check_your_mail'),
            ], 200);
        }
        return response()->json([
            'message' => trans('web_string.email_not_found'),
        ], 400);
    }

    public function resetPassword($token)
    {
        $tokenData = DB::table('password_reset_tokens')->get();
        $email = null;
        foreach ($tokenData as $data) {
            if (Hash::check($token, $data->token)) {
                $email = $data->email;
                break;
            }
        }
        if (!empty($email)) {
            return view('website.forgot-password.forgot-password',
                ['token' => $token,
                    'email' => $email]);
        }
        abort(404);
    }

    public function resetPasswordSubmit(ResetPasswordStoreRequest $request): JsonResponse
    {
        $password = $request->input('new_password');
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->input('email'))->first();
        if ($tokenData) {
            $user = User::where('email', $tokenData->email)->first();
            if ($user) {
                $user->password = Hash::make($password);
                $user->update();

                DB::table('password_reset_tokens')->where('email', $request['email'])->delete();
            } else {
                return response()->json(['message' => trans('web_string.email_not_found')], 422);
            }
            return response()->json(['message' => trans('web_string.password_reset_successfully')]);
        }
        return response()->json(['message' => trans('web_string.email_not_found')], 422);
    }
}
