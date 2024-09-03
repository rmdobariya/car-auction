<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordStoreRequest;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Mail\Web\ForgotPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use TaqnyatSms;

class LoginController extends Controller
{
    public function loginCheck(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $request->email)->whereIn('user_type', ['user', 'buyer', 'seller'])
            ->first();
        if ($request->login_otp == Session::get('login_otp')) {
            if (empty($user)) {
                return response()->json([
                    'message' => trans('web_string.invalid_email'),
                ], 401);
            } else if (!Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'message' => trans('web_string.invalid_password'),
                ], 401);
            } else {
                Session::forget('login_otp');
                Session::forget('login_email');
                Auth::login($user);
                return response()->json([
                    'user_type' => $user->user_type,
                    'message' => trans('web_string.login_successfully'),
                ]);
            }
        } else {
            return response()->json([
                'message' => trans('web_string.invalid_otp'),
            ], 401);
        }
    }

    public function register(RegisterRequest $request)
    {
        if ($request->otp == Session::get('otp')) {
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
            DB::table('notifications')->insert([
                'user_id' => $user->id,
                'first_name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'mobile_no' => $user->mobile_no,
                'type' => 'user_registration',
                'created_at' => Carbon::now(),
                'message' => $user->full_name . '|' . $user->email . ' ' . 'Registered On Zodha',
            ]);
            Session::forget('otp');
            Session::forget('contact_no');
            return response()->json([
                'message' => trans('web_string.register_successfully'),
            ]);
        } else {
            return response()->json([
                'message' => trans('web_string.otp_invalid'),
            ], 400);
        }
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
                DB::table('notifications')->insert([
                    'user_id' => $user->id,
                    'first_name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'mobile_no' => $user->mobile_no,
                    'created_at' => Carbon::now(),
                    'type' => 'forgot_password_request',
                    'message' => $user->email . ' ' . 'requested a password change',
                ]);
                DB::table('password_reset_tokens')->where('email', $request['email'])->delete();
            } else {
                return response()->json(['message' => trans('web_string.email_not_found')], 422);
            }
            return response()->json(['message' => trans('web_string.password_reset_successfully')]);
        }
        return response()->json(['message' => trans('web_string.email_not_found')], 422);
    }

    public function sendOtp(Request $request)
    {
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('contact_no', $request->contact_no);
        $bearer = 'Bearer e2f5bb78ed5b80135604bb70a8056a4f';
        $taqnyt = new TaqnyatSms($bearer);

        $body = trans('admin_string.your_otp_code_is') . ' ' . $otp . ' ' . trans('admin_string.please_do_not_share_this_code_with_anyone');
        $recipients = ['966' . $request->contact_no];
//        $recipients = ['966563205156'];
        $sender = 'Zodha';
        $taqnyt = $taqnyt->sendMsg($body, $recipients, $sender);
        \Log::info('Taqnyat Response:', (array)$taqnyt);
        \Log::info('SMS Text Registration:', ['body' => $body]);
        \Log::info('SMS Text Number:', $recipients);
        return response()->json([
            'message' => trans('web_string.please_check_your_mobile_for_sms'),
        ], 200);
    }

    public function loginSendOtp(Request $request)
    {
        $otp = rand(100000, 999999);
        Session::put('login_otp', $otp);
        Session::put('login_email', $request->email);
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return response()->json([
                'message' => trans('web_string.invalid_email'),
            ], 401);
        } else {
            $bearer = 'Bearer e2f5bb78ed5b80135604bb70a8056a4f';
            $taqnyt = new TaqnyatSms($bearer);

            $body = trans('admin_string.your_otp_code_is') . ' ' . $otp . ' ' . trans('admin_string.please_do_not_share_this_code_with_anyone');
            $recipients = ['966' . $user->contact_no];
//            $recipients = ['966563205156'];
            $sender = 'Zodha';
            $taqnyt = $taqnyt->sendMsg($body, $recipients, $sender);
            \Log::info('Taqnyat Response:', (array)$taqnyt);
            \Log::info('SMS Text Login:', ['body' => $body]);
            \Log::info('SMS Text Number:', [$recipients]);
            return response()->json([
                'message' => trans('web_string.please_check_your_mobile_for_sms'),
            ], 200);
        }
    }
}
