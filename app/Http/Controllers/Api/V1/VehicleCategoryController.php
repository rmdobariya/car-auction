<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleCategoryStoreRequest;
use App\Http\Resources\VehicleCategoryResource;
use App\Models\VehicleCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicle_category = VehicleCategory::where('user_id', $user->id)->whereNull('deleted_at')->get();
        $result = VehicleCategoryResource::collection($vehicle_category);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_category' => $result],
        ]);
    }

    public function store(VehicleCategoryStoreRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $vehicle_category = new VehicleCategory();
            $vehicle_category->user_id = $user->id;
            $vehicle_category->name = $request->name;
            $vehicle_category->save();

            return response()->json([
                'status' => true,
                'message' => 'Vehicle Category Insert Successfully',
            ]);
        }
        $vehicle_category = VehicleCategory::find($validated['edit_value']);
        $vehicle_category->user_id = $user->id;
        $vehicle_category->name = $request->name;
        $vehicle_category->save();

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Category Updated Successfully',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        VehicleCategory::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Category Delete Successfully'
        ]);
    }
}
