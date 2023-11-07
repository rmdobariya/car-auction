<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\API\FacebookRequest;
use App\Http\Requests\API\GoogleLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function socialGoogle(GoogleLoginRequest $request)
    {
        $user_type = $request->user_type;
        $user = User::where('google_id', $request->google_id)->first();
        if (!is_null($user)) {
            DB::table('users')->where('id',$user->id)->update([
                'user_type' => $user_type
            ]);
            $u = User::where('id', $user->id)->first();
            $tokenResult = $u->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($u->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => 'User Login successfully',
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($u)]
            ]);

        } else {
            $user = User::create([
                'name' => $request->first_name,
                'last_name' => $request->last_name,
                'full_name' => $request->first_name . ' ' . $request->last_name,
                'user_type' => $user_type,
                'google_id' => $request->google_id,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
            ]);

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => 'User registration successfully',
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($user)]
            ]);
        }

    }

    public function socialFacebook(FacebookRequest $request)
    {
        $user_type = $request->user_type;
        $user = User::where('facebook_id', $request->facebook_id)->first();
        if (!is_null($user)) {
            DB::table('users')->where('id',$user->id)->update([
                'user_type' => $user_type
            ]);
            $u = User::where('id', $user->id)->first();
            $tokenResult = $u->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($u->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => 'User Login successfully',
                'token' => $tokenResult,
                'data' => ['user_info' => new UserResource($u)]
            ]);
        } else {
            $user = User::create([
                'name' => $request->first_name,
                'last_name' => $request->last_name,
                'full_name' => $request->first_name . ' ' . $request->last_name,
                'user_type' => $user_type,
                'facebook_id' => $request->facebook_id,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
            ]);
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
            return response()->json([
                'status' => true,
                'message' => 'User registration successfully',
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
