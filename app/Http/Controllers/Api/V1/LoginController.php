<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginWithEmailRequest;
use App\Http\Requests\API\RegisterStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginWithEmailRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                $response_array = array(
                    'status' => false,
                    'message' => 'Please enter correct username or password',
                    'data' => null
                );
                return response()->json($response_array);
            }
            $user = User::where('email', $validated['email'])->first();
            if ((string)$user->status === 'active') {
                $this->addDeviceToken($user->id, $validated['device_type'], $validated['device_token']);
                $token = $user->createToken('authToken')->plainTextToken;
                $user = DB::table('users')
                    ->where('users.id', $user->id)
                    ->select(['users.*'])
                    ->first();
                $response_array = array(
                    'status' => true,
                    'token' => $token,
                    'data' => ['user_info' => new UserResource($user)]
                );
                return response()->json($response_array);
            }
            $response_array = array(
                'status' => false,
                'message' => 'Account Is Inactive',
                'data' => null
            );
            return response()->json($response_array);
        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'error' => $error->getMessage(),
            ], 422);
        }
    }

    public function register(RegisterStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $tokenResult = $user->createToken('authToken')->plainTextToken;
        $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
        return response()->json([
            'status' => true,
            'message' => 'User registration successfully',
            'token' => $tokenResult,
            'data' => ['user_info' => new UserResource($user)]
        ]);
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

    public function deleteToken($device_token): bool
    {
        Device::where('device_token', $device_token)->delete();
        return true;
    }
}
