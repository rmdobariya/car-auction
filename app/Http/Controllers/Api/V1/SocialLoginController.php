<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\API\FacebookRequest;
use App\Http\Requests\API\GoogleLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SocialLoginController extends Controller
{
    public function socialGoogle(GoogleLoginRequest $request)
    {
        $user_type = $request->user_type;
        $user = User::where('email', $request->email)->whereNull('deleted_at')->first();
        if (!is_null($user)) {
            DB::table('users')->where('id', $user->id)->update([
                'user_type' => $user_type
            ]);
            $u = User::where('id', $user->id)->first();
            $tokenResult = $u->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($u->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => trans('app_string.user_login_successfully'),
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($u)]
            ]);

        } else {
            $user = new User();
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->user_type = $request->user_type;
            $user->google_id = $request->google_id;
            $user->contact_no = $request->contact_no;
            $user->email = $request->email;
            $user->save();

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => trans('app_string.user_registration_successfully'),
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($user)]
            ]);
        }

    }

    public function socialFacebook(FacebookRequest $request)
    {
        $user_type = $request->user_type;
        $user = User::where('facebook_id', $request->facebook_id)->where('email', $request->email)->whereNull('deleted_at')->first();
        if (!is_null($user)) {
            DB::table('users')->where('id', $user->id)->update([
                'user_type' => $user_type
            ]);
            $u = User::where('id', $user->id)->first();
            $tokenResult = $u->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($u->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => trans('app_string.user_login_successfully'),
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($u)]
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->whereNull('deleted_at'),
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => trans('app_string.the_email_is_already_be_taken')
                ]);
            }
            $user = new User();
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->user_type = $request->user_type;
            $user->facebook_id = $request->facebook_id;
            $user->contact_no = $request->contact_no;
            $user->email = $request->email;
            $user->save();

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => trans('app_string.user_registration_successfully'),
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($user)]
            ]);
        }
    }


    public function addDeviceToken($user_id, $device_type, $device_token): bool
    {
        $this->deleteToken($device_token);
        $device = new Device();
        $device->user_id = $user_id;
        $device->device_type = $device_type;
        $device->device_token = $device_token;
        $device->save();
        return true;
    }

    public
    function deleteToken($device_token): bool
    {
        Device::where('device_token', $device_token)->delete();
        return true;
    }
}
