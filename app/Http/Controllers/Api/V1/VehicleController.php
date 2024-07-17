<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleChangeStatusStoreRequest;
use App\Http\Requests\API\VehicleStoreRequest;
use App\Http\Resources\EditVehicleResource;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Models\VehicleDocument;
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
        $vehicle = DB::table('vehicles')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
//            ->where('vehicles.user_id', $user->id)
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->whereNull('vehicles.deleted_at')
            ->orderBy('vehicles.id', 'desc');
        if (!is_null($request->name)) {
            $vehicle = $vehicle->where('vehicle_translations.name', 'like', '%' . $request->name . '%');
        }
        if (!is_null($request->status)) {
            $vehicle = $vehicle->where('vehicles.status', 'like', '%' . $request->status . '%');
        } else {
            $vehicle = $vehicle->where('vehicles.status', 'approve');
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
        $vehicle = $vehicle->select('vehicles.*', 'category_translations.name as vehicle_category_name', 'vehicle_translations.name  as vehicle_name',
            'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage',)
            ->get();
        $result = VehicleResource::collection($vehicle);
        if (count($vehicle) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['vehicle' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['vehicle' => $result],
            ]);
        }
    }

    public function pendingVehicle(Request $request): JsonResponse
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->whereNull('vehicles.deleted_at')
            ->where('vehicles.status', 'pending')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'category_translations.name as vehicle_category_name', 'vehicle_translations.name  as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage',)
            ->get();
        $result = VehicleResource::collection($vehicle);
        if (count($vehicle) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['vehicle' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['vehicle' => $result],
            ]);
        }
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $vehicle = new Vehicle();
            $vehicle->user_id = $user->id;
            $vehicle->vehicle_category_id = $request->vehicle_category_id;
            $vehicle->city_id = $request->city_id;
            $vehicle->year = $request->year;
            $vehicle->kms_driven = $request->kms_driven;
            $vehicle->owners = $request->owners;
            $vehicle->price = $request->price;
            $vehicle->bid_increment = $request->bid_increment;
            $vehicle->auction_start_date = $request->auction_start_date;
            $vehicle->auction_end_date = $request->auction_end_date;
            $vehicle->auction_start_time = $request->auction_start_time;
            $vehicle->auction_end_time = $request->auction_end_time;
            $vehicle->ratting = $request->ratting;
            $vehicle->is_vehicle_type = $request['is_vehicle_type'];
            if ($request->hasfile('main_image')) {
                $image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
                $vehicle->main_image = $image;
            }
            if ($request->hasfile('car_report')) {
                $car_report = ImageUploadHelper::imageUpload($request->file('car_report'), 'vehicle');
                $vehicle->car_report = $car_report;
            }
            $vehicle->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                VehicleTranslation::create([
                    'name' => $request->input($language['language_code'] . '_name'),
//                    'short_description' => $request->input($language['language_code'] . '_short_description'),
                    'make' => $request->input($language['language_code'] . '_make'),
                    'model' => $request->input($language['language_code'] . '_model'),
                    'trim' => $request->input($language['language_code'] . '_trim'),
                    'transmission' => $request->input($language['language_code'] . '_transmission'),
                    'fuel_type' => $request->input($language['language_code'] . '_fuel_type'),
                    'body_type' => $request->input($language['language_code'] . '_body_type'),
                    'registration' => $request->input($language['language_code'] . '_registration'),
                    'color' => $request->input($language['language_code'] . '_color'),
                    'car_type' => $request->input($language['language_code'] . '_car_type'),
                    'mileage' => $request->input($language['language_code'] . '_mileage'),
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
            if ($request->hasfile('document')) {
                foreach ($request->file('document') as $document) {
                    $image_path = 'vehicle-document';
                    if (!File::exists(public_path() . "/" . $image_path)) {
                        File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
                    }
                    $image_name = $document->getClientOriginalName();
                    $destination_path = public_path() . '/' . $image_path;
                    $file_name = uniqid() . '-' . $image_name;
                    $document->move($destination_path, $file_name);
                    $image = $image_path . '/' . $file_name;
                    $vehicle_document = new VehicleDocument();
                    $vehicle_document->vehicle_id = $vehicle->id;
                    $vehicle_document->document = $image;
                    $vehicle_document->save();
                }

            }
            return response()->json([
                'status' => true,
                'message' => trans('app_string.vehicle_insert_successfully'),
            ]);
        }
        $vehicle = Vehicle::find($validated['edit_value']);
        $vehicle->user_id = $user->id;
        $vehicle->vehicle_category_id = $request->vehicle_category_id;
        $vehicle->city_id = $request->city_id;
        $vehicle->year = $request->year;
        $vehicle->kms_driven = $request->kms_driven;
        $vehicle->owners = $request->owners;
        $vehicle->price = $request->price;
        $vehicle->auction_start_date = $request->auction_start_date;
        $vehicle->auction_end_date = $request->auction_end_date;
        $vehicle->auction_start_time = $request->auction_start_time;
        $vehicle->auction_end_time = $request->auction_end_time;
        $vehicle->bid_increment = $request->bid_increment;
        $vehicle->ratting = $request->ratting;
        $vehicle->is_vehicle_type = $request['is_vehicle_type'];
        if ($request->hasfile('main_image')) {
            $main_image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
            $vehicle->main_image = $main_image;
        }
        if ($request->hasfile('car_report')) {
            $car_report = ImageUploadHelper::imageUpload($request->file('car_report'), 'vehicle');
            $vehicle->car_report = $car_report;
        }
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
//                    'short_description' => $request->input($language['language_code'] . '_short_description'),
                    'make' => $request->input($language['language_code'] . '_make'),
                    'model' => $request->input($language['language_code'] . '_model'),
                    'trim' => $request->input($language['language_code'] . '_trim'),
                    'transmission' => $request->input($language['language_code'] . '_transmission'),
                    'fuel_type' => $request->input($language['language_code'] . '_fuel_type'),
                    'body_type' => $request->input($language['language_code'] . '_body_type'),
                    'registration' => $request->input($language['language_code'] . '_registration'),
                    'color' => $request->input($language['language_code'] . '_color'),
                    'car_type' => $request->input($language['language_code'] . '_car_type'),
                    'mileage' => $request->input($language['language_code'] . '_mileage'),
                    'description' => $request->input($language['language_code'] . '_description'),
                ]);
        }

        if ($request->hasfile('other_image')) {
//            $images = DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->get();
//            foreach ($images as $image) {
//                ImageUploadHelper::deleteImage($image->image);
//            }
//            DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->delete();
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
        if ($request->hasfile('document')) {
//                $images = DB::table('vehicle_documents')->where('vehicle_id', $vehicle->id)->get();
//                foreach ($images as $image) {
//                    ImageUploadHelper::deleteDocument($image->document);
//                }
            foreach ($request->file('document') as $document) {
                $image_path = 'vehicle-document';
                if (!File::exists(public_path() . "/" . $image_path)) {
                    File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
                }
                $image_name = $document->getClientOriginalName();
                $destination_path = public_path() . '/' . $image_path;
                $file_name = uniqid() . '-' . $image_name;
                $document->move($destination_path, $file_name);
                $image = $image_path . '/' . $file_name;
                $vehicle_document = new VehicleDocument();
                $vehicle_document->vehicle_id = $vehicle->id;
                $vehicle_document->document = $image;
                $vehicle_document->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => trans('app_string.vehicle_update_successfully'),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Vehicle::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => trans('app_string.vehicle_delete_successfully')
        ]);
    }

    public function changeStatus($id, VehicleChangeStatusStoreRequest $request): JsonResponse
    {
        Vehicle::where('id', $id)->update([
            'status' => $request->status
        ]);
        return response()->json([
            'status' => true,
            'message' => trans('app_string.vehicle_status_change_successfully')
        ]);
    }

    public function show($id, Request $request): JsonResponse
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
//            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at')
            ->select('vehicles.*', 'category_translations.name as vehicle_category_name', 'vehicle_translations.name  as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage')
            ->get();
        $result = VehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_detail' => $result],
        ]);
    }
    public function editVehicleResponse($id, Request $request): JsonResponse
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('city_translations', 'vehicles.city_id', 'city_translations.city_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('city_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
//            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at')
            ->select('vehicles.*', 'category_translations.name as vehicle_category_name','category_translations.category_id as vehicle_category_id','city_translations.name as city_name','city_translations.city_id as city_id', 'vehicle_translations.name  as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.make',
                'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission',
                'vehicle_translations.fuel_type', 'vehicle_translations.body_type',
                'vehicle_translations.registration', 'vehicle_translations.color',
                'vehicle_translations.car_type', 'vehicle_translations.mileage')
            ->get();
        $result = EditVehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_detail' => $result],
        ]);
    }

    public function removeDocument($id)
    {
        $vehicle_document = DB::table('vehicle_documents')->where('id', $id)->first();
        ImageUploadHelper::deleteDocument($vehicle_document->document);
        DB::table('vehicle_documents')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => trans('app_string.vehicle_document_delete_successfully'),
        ]);
    }

    public function removeImage($id)
    {
        $vehicle_image = DB::table('vehicle_images')->where('id', $id)->first();
        ImageUploadHelper::deleteImage($vehicle_image->image);
        DB::table('vehicle_images')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => trans('app_string.vehicle_image_delete_successfully'),
        ]);
    }
}
