<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $cities = DB::table('cities')
            ->leftjoin('city_translations','cities.id','city_translations.city_id')
            ->where('cities.status','active')
            ->where('city_translations.locale',App::getLocale())
            ->whereNull('cities.deleted_at')
            ->select('cities.*','city_translations.name')
            ->get();
        $result = CityResource::collection($cities);
        if (count($cities) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['city' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['city' => $result],
            ]);
        }
    }
}
