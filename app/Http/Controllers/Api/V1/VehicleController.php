<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleChangeStatusStoreRequest;
use App\Http\Requests\API\VehicleStoreRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\VehicleTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicles.user_id', $user->id)
            ->where('vehicle_translations.locale', App::getLocale())
            ->whereNull('vehicles.deleted_at');
        if (!is_null($request->name)) {
            $vehicle = $vehicle->where('vehicle_translations.name', 'like', '%' . $request->name . '%');
        }
        if (!is_null($request->status)) {
            $vehicle = $vehicle->where('vehicles.status', 'like', '%' . $request->status . '%');
        }
        if (!is_null($request->is_product)) {
            $vehicle = $vehicle->where('vehicles.is_product', $request->is_product);
        }
        if (!is_null($request->is_vehicle_type)) {
            $vehicle = $vehicle->where('vehicles.is_vehicle_type', $request->is_vehicle_type);
        }
        if (!is_null($request->vehicle_category_id)) {
            $vehicle = $vehicle->where('vehicles.vehicle_category_id', 'like', '%' . $request->vehicle_category_id . '%');
        }
        $vehicle = $vehicle->select('vehicles.*', 'vehicle_categories.name as vehicle_category_name', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description')
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
            $vehicle = new Vehicle();
            $vehicle->user_id = $user->id;
            $vehicle->vehicle_category_id = $request->vehicle_category_id;
            $vehicle->year = $request->year;
            $vehicle->make = $request->make;
            $vehicle->model = $request->model;
            $vehicle->trim = $request->trim;
            $vehicle->kms_driven = $request->kms_driven;
            $vehicle->owners = $request->owners;
            $vehicle->transmission = $request->transmission;
            $vehicle->fuel_type = $request->fuel_type;
            $vehicle->body_type = $request->body_type;
            $vehicle->registration = $request->registration;
            $vehicle->mileage = $request->mileage;
            $vehicle->price = $request->price;
            $vehicle->color = $request->color;
            $vehicle->type = $request->car_type;
            $vehicle->ratting = $request->ratting;
//            $vehicle->minimum_bid_increment_price = $request->minimum_bid_increment_price;
            $vehicle->bid_increment = $request->bid_increment;
            $vehicle->is_vehicle_type = $request['is_vehicle_type'];
            $vehicle->auction_start_date = $request->auction_start_date;
            $vehicle->auction_end_date = $request->auction_end_date;
            if ($request->hasfile('main_image')) {
                $image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
                $vehicle->main_image = $image;
            }
            $vehicle->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                VehicleTranslation::create([
                    'name' => $request->input($language['language_code'] . '_name'),
                    'short_description' => $request->input($language['language_code'] . '_short_description'),
                    'description' => $request->input($language['language_code'] . '_description'),
                    'vehicle_id' => $vehicle->id,
                    'locale' => $language['language_code'],
                ]);
            }
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
        $vehicle->vehicle_category_id = $request->vehicle_category_id;
        $vehicle->year = $request->year;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->trim = $request->trim;
        $vehicle->kms_driven = $request->kms_driven;
        $vehicle->owners = $request->owners;
        $vehicle->transmission = $request->transmission;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->body_type = $request->body_type;
        $vehicle->registration = $request->registration;
        $vehicle->mileage = $request->mileage;
        $vehicle->price = $request->price;
        $vehicle->color = $request->color;
        $vehicle->type = $request->car_type;
        $vehicle->ratting = $request->ratting;
//        $vehicle->minimum_bid_increment_price = $request->minimum_bid_increment_price;
        $vehicle->bid_increment = $request->bid_increment;
        $vehicle->is_vehicle_type = $request['is_vehicle_type'];
        $vehicle->auction_start_date = $request->auction_start_date;
        $vehicle->auction_end_date = $request->auction_end_date;
        $vehicle->save();

        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        foreach ($languages as $language) {
            VehicleTranslation::updateOrCreate(
                [
                    'vehicle_id' => $validated['edit_value'],
                    'locale' => $language['language_code'],
                ],
                [
                    'vehicle_id' => $validated['edit_value'],
                    'locale' => $language['language_code'],
                    'name' => $request->input($language['language_code'] . '_name'),
                    'description' => $request->input($language['language_code'] . '_description'),
                    'short_description' => $request->input($language['language_code'] . '_short_description'),
                ]);
        }

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
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at')
            ->select('vehicles.*', 'vehicle_categories.name as vehicle_category_name', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description')
            ->get();
        $result = VehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_detail' => $result],
        ]);
    }

}
