<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Web\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function index($token)
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
            return view('website.profile.reset-password',
                ['token' => $token,
                    'email' => $email]);
        }
        abort(404);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $password = $request->input('new_password');

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->input('email'))->first();

        if ($tokenData) {
            $user = User::where('email', $tokenData->email)->first();
            if ($user) {
                $user->password = bcrypt($password);
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
