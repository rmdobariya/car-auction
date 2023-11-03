<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleCategoryStoreRequest;
use App\Http\Resources\VehicleCategoryResource;
use App\Models\VehicleCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class VehicleCategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $vehicle_category = DB::table('categories')
            ->leftjoin('category_translations','categories.id','category_translations.category_id')
            ->where('categories.status','active')
            ->where('category_translations.locale',App::getLocale())
            ->whereNull('deleted_at')
            ->select('categories.*','category_translations.name as vehicle_category_name')
            ->get();
        $result = VehicleCategoryResource::collection($vehicle_category);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_category' => $result],
        ]);
    }
}
