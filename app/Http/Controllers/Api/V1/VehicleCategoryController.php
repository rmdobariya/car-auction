<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class VehicleCategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $vehicle_category = DB::table('categories')
            ->leftjoin('category_translations', 'categories.id', 'category_translations.category_id')
            ->where('categories.status', 'active')
            ->where('category_translations.locale', App::getLocale())
            ->whereNull('deleted_at')
            ->select('categories.*', 'category_translations.name as vehicle_category_name')
            ->get();
        $result = VehicleCategoryResource::collection($vehicle_category);
        if (count($vehicle_category) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['vehicle_category' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['vehicle_category' => $result],
            ]);
        }
    }
}
