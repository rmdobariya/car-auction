<?php

namespace App\Http\Controllers\Web;

use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\VehicleStoreRequest;
use App\Models\TempDocument;
use App\Models\TempImage;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleDocument;
use App\Models\VehicleImage;
use App\Models\VehicleTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function create()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->where('user_type', 'seller')->first();
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = VehicleCategory::where('status', 'active')->whereNull('deleted_at')->get();
        if ($user) {
            return view('website.vehicle.add-car', [
                'user' => $user,
                'languages' => $languages,
                'vehicle_categories' => $vehicle_categories,
            ]);
        }
        abort(404);
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->where('user_type', 'seller')->first();
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = VehicleCategory::whereNull('deleted_at')->get();
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->get();
        $vehicleDocuments = VehicleDocument::where('vehicle_id', $id)->get();
        $vehicle = Vehicle::where('id', $id)->first();
        if ($user) {
            return view('website.vehicle.edit-car', [
                'user' => $user,
                'languages' => $languages,
                'vehicle_categories' => $vehicle_categories,
                'vehicle' => $vehicle,
                'vehicleImages' => $vehicleImages,
                'vehicleDocuments' => $vehicleDocuments,
            ]);
        }
        abort(404);
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        DB::beginTransaction();
        if ((int)$validated['edit_value'] === 0) {
            try {
                $vehicle = new Vehicle();
                $vehicle->user_id = Auth::user()->id;
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
                $vehicle->ratting = $request->ratingvalue;
                $vehicle->minimum_bid_increment_price = $request->minimumBidIncrement;
                $vehicle->bid_increment = $request->bid_increment;
                $vehicle->is_vehicle_type = $request['is_vehicle_type'];
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
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
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);

                TempImage::where('temp_time', $request->temp_time)->delete();

                $documents = TempDocument::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleDocument($documents, $vehicle->id);

                TempDocument::where('temp_time', $request->temp_time)->delete();

                DB::commit();
                return response()->json(['message' => trans('web_string.car_add_successfully')]);
            } catch
            (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 522);
            }
        } else {
            try {
                $vehicle = Vehicle::find($validated['edit_value']);
                $vehicle->user_id = Auth::user()->id;
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
                $vehicle->ratting = $request->ratingvalue;
                $vehicle->minimum_bid_increment_price = $request->minimumBidIncrement;
                $vehicle->bid_increment = $request->bid_increment;
                $vehicle->is_vehicle_type = $request['is_vehicle_type'];
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
                if ($request->hasfile('main_image')) {
                    $image = ImageUploadHelper::imageUpload($request->file('main_image'), 'vehicle');
                    $vehicle->main_image = $image;
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
                            'description' => $request->input($language['language_code'] . '_description'),
                            'short_description' => $request->input($language['language_code'] . '_short_description'),
                        ]);
                }
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);

                TempImage::where('temp_time', $request->temp_time)->delete();

                $documents = TempDocument::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleDocument($documents, $vehicle->id);

                TempDocument::where('temp_time', $request->temp_time)->delete();

                DB::commit();
                return response()->json(['message' => trans('web_string.car_update_successfully')]);
            } catch
            (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 522);
            }
        }
    }

    public function imageUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $files = $request->qqfile;
        $image_path = 'vehicle';
        $extension = $files->getClientOriginalExtension();
        $image_name = $image_path . '/' . uniqid() . '.' . $extension;
        $files->move($image_path, $image_name);
        $tmpImage = new TempImage();
        $tmpImage->name = $image_name;
        $tmpImage->temp_id = $request->qquuid;
        $tmpImage->temp_time = $request->temp_time;
        $tmpImage->save();
        return response()->json([
            'success' => true,
        ]);
    }

    function imageDelete($id)
    {
        $image = TempImage::where('temp_id', $id)->first()->name;
        ImageUploadHelper::deleteImage($image);
        TempImage::where('temp_id', $id)->delete();
    }

    public function documentUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $files = $request->qqfile;
        $image_path = 'vehicle-document';
        $extension = $files->getClientOriginalExtension();
        $image_name = $image_path . '/' . uniqid() . '.' . $extension;
        $files->move($image_path, $image_name);
        $tmpImage = new TempDocument();
        $tmpImage->name = $image_name;
        $tmpImage->temp_id = $request->qquuid;
        $tmpImage->temp_time = $request->temp_time;
        $tmpImage->save();
        return response()->json([
            'success' => true,
        ]);
    }

    function documentDelete($id)
    {
        $image = TempDocument::where('temp_id', $id)->first()->name;
        ImageUploadHelper::deleteImage($image);
        TempImage::where('temp_id', $id)->delete();
    }


    public function getVehicleGallery(Request $request)
    {
        $id = $request['product_id'];
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->get();
        $view = view('website.vehicle.car_gallery', [
            'vehicleImages' => $vehicleImages
        ])->render();

        return response()->json([
            'data' => $view
        ]);
    }

    public function getVehicleDocument(Request $request)
    {
        $id = $request['product_id'];
        $vehicleDocuments = VehicleDocument::where('vehicle_id', $id)->get();

        $view = view('website.vehicle.car_document', [
            'vehicleDocuments' => $vehicleDocuments
        ])->render();

        return response()->json([
            'data' => $view
        ]);
    }

    public function deleteVehicleImage($id)
    {
        $image = VehicleImage::where('id', $id)->first();
        if ($image) {
            ImageUploadHelper::deleteImage($image->image);
            VehicleImage::where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'message' => trans('web_string.image_delete_successfully')]);

    }

    public function deleteVehicleDocument($id)
    {
        $image = VehicleDocument::where('id', $id)->first();
        if ($image) {
            ImageUploadHelper::deleteImage($image->image);
            VehicleDocument::where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'message' => trans('web_string.document_delete_successfully')]);
    }

    public function destroy($id): JsonResponse
    {
        Vehicle::where('id', $id)->delete();
        return response()->json([
            'message' => trans('web_string.car_delete_successfully')
        ]);
    }
}
