<?php

namespace App\Http\Controllers\Web;

use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\VehicleStoreRequest;
use App\Models\Page;
use App\Models\User;
use App\Models\Vehicle;
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
        $user = User::where('id', $user_id)->first();
        if ($user) {
            return view('website.vehicle.add-car', ['user' => $user]);

        }
        abort(404);
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        DB::beginTransaction();
            try {
                $vehicle = new Vehicle();
                $vehicle->user_id = Auth::user()->id;
//                $vehicle->vehicle_category_id = $request->vehicle_category_id;
                $vehicle->year = $request->year;
                $vehicle->make = $request->make;
                $vehicle->model = $request->model;
                $vehicle->mileage = $request->milage;
                $vehicle->description = $request->description;
                $vehicle->body_type = $request->bodType;
                $vehicle->color = $request->exterioColor;
                $vehicle->type = $request->carType;
                $vehicle->ratting = $request->ratingvalue;
                $vehicle->price = $request->initialPrice;
                $vehicle->minimum_bid_increment_price = $request->minimumBidIncrement;
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
//                $vehicle->transmission = $request->transmission;
//                $vehicle->trim = $request->trim;
//                $vehicle->kms_driven = $request->kms_driven;
//                $vehicle->owners = $request->owners;
//                $vehicle->fuel_type = $request->fuel_type;
//                $vehicle->registration = $request->registration;
//                $vehicle->price = $request->price;
//                $vehicle->short_description = $request->short_description;
//                if ($request->hasfile('vehicleImage')) {
//                    $image = ImageUploadHelper::imageUpload($request->file('vehicleImage'[0]), 'vehicle');
//                    $vehicle->main_image = $image;
//                }
                $vehicle->save();
                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    VehicleTranslation::create([
                        'name' => $request->input('carname'),
                        'vehicle_id' => $vehicle->id,
                        'locale' => $language['language_code'],
                    ]);
                }
                if (!is_null($request['vehicleImage'])){
                    foreach ($request['vehicleImage'] as $image){
                        $val = ImageUploadHelper::imageUpload($image, 'vehicle');
                        $image = new VehicleImage();
                        $image->vehicle_id = $vehicle->id;
                        $image->image = $val;
                        $image->save();
                    }
                }

                if (!is_null($request['vehicleDocument'])){
                    foreach ($request['vehicleDocument'] as $document){
                        $val = ImageUploadHelper::imageUpload($document, 'vehicle-document');
                        $image = new VehicleDocument();
                        $image->vehicle_id = $vehicle->id;
                        $image->document = $val;
                        $image->save();
                    }
                }

                DB::commit();
                return response()->json(['message' => "Vehicle Added Successfully"]);
            } catch
            (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 522);
            }
    }
}
