<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginWithEmailRequest;
use App\Http\Requests\API\RegisterStoreRequest;
use App\Http\Resources\ModalHotDealVehicleResource;
use App\Http\Resources\UserResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\App;
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
                    'message' => trans('app_string.please_enter_correct_username_or_password'),
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
                'message' => trans('app_string.account_is_inactive'),
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
        $user->name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->full_name = $request->first_name . ' ' . $request->last_name;
        $user->contact_no = $request->contact_no;
        $user->user_type = $request->user_type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
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

    public function modalHotDealVehicle()
    {
        $modal_hot_deal_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_hot_deal')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.id as vehicle_id','vehicles.main_image as main_image', 'vehicle_translations.name as vehicle_name')
            ->get();
        return response()->json([
            'status' => true,
            'data' => ['modal_hot_deal_vehicles' => ModalHotDealVehicleResource::collection($modal_hot_deal_vehicles)]
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

    public function bankDetail()
    {
        $bank_name = DB::table('site_settings')->where('setting_key','BANK_NAME')->first()->setting_value;
        $iban = DB::table('site_settings')->where('setting_key','IBAN')->first()->setting_value;
        $ac_no = DB::table('site_settings')->where('setting_key','ACCOUNT_NO')->first()->setting_value;
        $location = DB::table('site_settings')->where('setting_key','LOCATION')->first()->setting_value;
        $nation_id_no = DB::table('site_settings')->where('setting_key','NATIONAL_ID_NO')->first()->setting_value;
        $result = [
            'bank_name' =>$bank_name,
            'iban' =>$iban,
            'ac_no' =>$ac_no,
            'location' =>$location,
            'nation_id_no' =>$nation_id_no,
        ];
        return response()->json([
            'status' => true,
//            'message' => trans('app_string.data_not_found'),
            'data' => ['bank_detail' => $result],
        ]);
    }
}
