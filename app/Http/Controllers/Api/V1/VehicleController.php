<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleChangeStatusStoreRequest;
use App\Http\Requests\API\VehicleStoreRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at');
        if (!is_null($request->name)) {
            $vehicle = $vehicle->where('vehicles.name', 'like', '%' . $request->name . '%');
        }
        if (!is_null($request->status)) {
            $vehicle = $vehicle->where('vehicles.status', 'like', '%' . $request->status . '%');
        }
        if (!is_null($request->vehicle_category_id)) {
            $vehicle = $vehicle->where('vehicles.vehicle_category_id', 'like', '%' . $request->vehicle_category_id . '%');
        }
        $vehicle = $vehicle->select('vehicles.*', 'vehicle_categories.name as vehicle_category_name')
            ->get();
        $result = VehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle' => $result],
        ]);
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            if ($request->hasfile('main_image')) {
                $main_image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
            }
            $vehicle = new Vehicle();
            $vehicle->user_id = $user->id;
            $vehicle->name = $request->name;
            $vehicle->vehicle_category_id = $request->vehicle_category_id;
            $vehicle->model = $request->model;
            $vehicle->year = $request->year;
            $vehicle->short_description = $request->short_description;
            $vehicle->description = $request->description;
            $vehicle->main_image = $main_image;
            $vehicle->status = $request->status;
            $vehicle->save();

            if ($request->hasfile('other_image')) {
                foreach ($request->file('other_image') as $files) {
                    $image_path = 'vehicle';
                    if (!File::exists(public_path() . "/" . $image_path)) {
                        File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
                    }
                    $image_name = $files->getClientOriginalName();
                    $destination_path = public_path() . '/' . $image_path;
                    $file_name = uniqid() . '-' . $image_name;
                    $files->move($destination_path, $file_name);
                    $image = $image_path . '/' . $file_name;
                    $vehicle_image = new VehicleImage();
                    $vehicle_image->vehicle_id = $vehicle->id;
                    $vehicle_image->image = $image;
                    $vehicle_image->save();
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Vehicle Insert Successfully',
            ]);
        }
        if ($request->hasfile('main_image')) {
            $main_image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
        }
        $vehicle = Vehicle::find($validated['edit_value']);
        $vehicle->user_id = $user->id;
        $vehicle->name = $request->name;
        $vehicle->vehicle_category_id = $request->vehicle_category_id;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->short_description = $request->short_description;
        $vehicle->description = $request->description;
        $vehicle->main_image = $main_image;
        $vehicle->status = $request->status;
        $vehicle->save();

        if ($request->hasfile('other_image')) {
            $images = DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->get();
            foreach ($images as $image) {
                ImageUploadHelper::deleteImage($image->image);
            }
            DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->delete();
            foreach ($request->file('other_image') as $files) {
                $image_path = 'vehicle';
                if (!File::exists(public_path() . "/" . $image_path)) {
                    File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
                }
                $image_name = $files->getClientOriginalName();
                $destination_path = public_path() . '/' . $image_path;
                $file_name = uniqid() . '-' . $image_name;
                $files->move($destination_path, $file_name);
                $image = $image_path . '/' . $file_name;
                $vehicle_image = new VehicleImage();
                $vehicle_image->vehicle_id = $vehicle->id;
                $vehicle_image->image = $image;
                $vehicle_image->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Updated Successfully',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Vehicle::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Delete Successfully'
        ]);
    }

    public function changeStatus($id, VehicleChangeStatusStoreRequest $request): JsonResponse
    {
        Vehicle::where('id', $id)->update([
            'status' => $request->status
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Status Change Successfully'
        ]);
    }

    public function show($id, Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->where('vehicles.id', $id)
            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at')
            ->select('vehicles.*', 'vehicle_categories.name as vehicle_category_name')
            ->get();
        $result = VehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_detail' => $result],
        ]);
    }

}
