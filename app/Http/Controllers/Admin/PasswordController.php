<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordStoreRequest;
use App\Http\Requests\Admin\ResetPasswordStoreRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.change-password');
    }

    public function updatePassword(ChangePasswordStoreRequest $request): JsonResponse
    {
        $id = Auth::guard('admin')->user()->id;
        $user = User::find($id);
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        if (!Hash::check($current_password, $user->password)) {
            return response()->json(['message' => 'Current Password Is Invalid'], 500);
        }
        User::where('id', $id)->update([
            'password' => bcrypt($new_password),
        ]);
        return response()->json(['message' => 'Password Change Successfully']);
    }

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            $token = Password::getRepository()->create($user);
            $array = [
                'name' => $user->name,
                'actionUrl' => route('admin.reset-password', [$token]),
                'mail_title' => 'Password Reset',
                'reset_password_subject' => 'Password Reset',
                'main_title_text' => 'Forgot Your Password',
                'subject' => 'Password Reset',
            ];
            Mail::to($request->input('email'))->send(new ForgotPasswordMail($array));
            return response()->json([
                'message' => 'Please Check Your Mail',
            ], 200);
        }
        return response()->json([
            'message' => 'Email Not Found',
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
            return view('admin.forgot-password.forgot-password',
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
                return response()->json(['message' => 'Email not found'], 422);
            }
            return response()->json(['message' => 'Password reset successfully!']);
        }
        return response()->json(['message' => 'Email not found'], 422);
    }

}
