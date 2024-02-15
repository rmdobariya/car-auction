<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $setting = DB::table('site_settings')
            ->where('setting_key', '!=', 'FAVICON_IMG')
            ->where('setting_key', '!=', 'FROM_EMAIL')
            ->get();
        $result = SettingResource::collection($setting);
        if (count($setting) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['setting' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['setting' => $result],
            ]);
        }
    }
}
