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
        if (count($vehicle_category) > 0) {
            $result = VehicleCategoryResource::collection($vehicle_category);
            return response()->json([
                'status' => true,
                'data' => ['vehicle_category' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => [],
            ]);
        }
    }
}
