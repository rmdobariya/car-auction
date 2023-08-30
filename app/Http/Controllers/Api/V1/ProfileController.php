<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ChangePasswordStoreRequest;
use App\Http\Requests\API\ForgotPasswordRequest;
use App\Http\Requests\API\UserProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user = DB::table('users')
                ->where('users.id', $user->id)
                ->select(['users.*'])
                ->first();
            return response()->json([
                'status' => true,
                'data' => ['user_info' => new UserResource($user)],
            ]);
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): JsonResponse
    {

        $user = User::where('id', $request->user()->id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        DB::commit();
        return response()->json([
            'status' => true,
            'message' => 'Profile Update Successfully',
        ]);
    }

    public function updatePassword(ChangePasswordStoreRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $user = User::find($request->user()->id);
            if ($user) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Old Password Is Wrong',
                    ], 422);
                }
                $user->password = Hash::make($request->new_password);
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Password Update Successfully',
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => trans('messages.error'),
            ]);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $user = User::where(['email' => $request['email']])->first();
        if ($user) {
            $token = Password::getRepository()->create($user);
            $array = [
                'name' => $user->name,
                'actionUrl' => route('reset-password', [$token]),
                'reset_password_subject' => 'Forgot password',
                'reset_password_body' => 'Reset Password',
            ];
            Mail::to($request['email'])->send(new ResetPasswordMail($array));
            return response()->json([
                'status' => true,
                'message' => 'Please Check Your Mail',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => trans('messages.email_not_register'),
        ]);
    }

}
