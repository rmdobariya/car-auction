<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class EditVehicleResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id', $this->id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id', $this->id)->get();
        $ar_name = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->name;
        $ar_make = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->make;
        $ar_model = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->model;
        $ar_trim = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->trim;
        $ar_transmission = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->transmission;
        $ar_fuel_type = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->fuel_type;
        $ar_body_type = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->body_type;
        $ar_registration = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->registration;
        $ar_color = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->color;
        $ar_car_type = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->car_type;
        $ar_mileage = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->mileage;
        $ar_short_description = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->short_description;
        $ar_description = DB::table('vehicle_translations')->where('vehicle_id', $this->id)->where('locale','ar')->first()->description;
        $ar_vc_name = DB::table('category_translations')->where('category_id', $this->vehicle_category_id)->where('locale','ar')->first()->name;
        $ar_city_name = DB::table('city_translations')->where('city_id', $this->city_id)->where('locale','ar')->first()->name;
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->count();
        $my_bid_amount = 0;
        $is_wishlist = 0;
        $height_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->max('amount');
        if (!is_null($request->user_id)) {
            $wishlist = DB::table('wish_lists')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->first();
            if (!is_null($wishlist)) {
                $is_wishlist = 1;
            } else {
                $is_wishlist = 0;
            }
            $my_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->orderBy('id', 'desc')->first();
            if (!is_null($my_bid)){
                $my_bid_amount = $my_bid->amount;
            }else{
                $my_bid_amount = 0;
            }
            $height_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->max('amount');
        }
        if (!is_null($this->auction_end_date)) {
            $current_date = Carbon::now();
            if ($this->auction_end_date > $current_date) {
                $end_date = Carbon::createFromFormat('Y-m-d', $this->auction_end_date)->endOfDay();
                $diff = $current_date->diff($end_date);
                $days = $diff->days;
                $hours = $diff->h;
                $minute = $diff->i;
                $second = $diff->s;
            } else {
                $days = 0;
                $hours = 0;
                $minute = 0;
                $second = 0;
            }
        } else {
            $days = 0;
            $hours = 0;
            $minute = 0;
            $second = 0;
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->vehicle_name,
            'ar_name' => $ar_name,
            'vehicle_category_id' => $this->vehicle_category_id,
            'ar_vehicle_category_name' => $ar_vc_name,
            'vehicle_category_name' => $this->vehicle_category_name,
            'city_id' => $this->city_id,
            'city_name' => $this->city_name,
            'ar_city_name' => $ar_city_name,
            'year' => $this->year,
            'make' => $this->make,
            'ar_make' => $ar_make,
            'model' => $this->model,
            'ar_model' => $ar_model,
            'trim' => $this->trim,
            'ar_trim' => $ar_trim,
            'kms_driven' => $this->kms_driven,
            'owners' => $this->owners,
            'transmission' => $this->transmission,
            'ar_transmission' => $ar_transmission,
            'fuel_type' => $this->fuel_type,
            'ar_fuel_type' => $ar_fuel_type,
            'body_type' => $this->body_type,
            'ar_body_type' => $ar_body_type,
            'registration' => $this->registration,
            'ar_registration' => $ar_registration,
            'color' => $this->color,
            'ar_color' => $ar_color,
            'mileage' => $this->mileage,
            'ar_mileage' => $ar_mileage,
            'car_type' => $this->car_type,
            'ar_car_type' => $ar_car_type,
            'price' => $this->price,
            'bid_increment' => $this->bid_increment,
            'ratting' => $this->ratting,
            'is_product' => $this->is_product,
            'is_vehicle_type' => $this->is_vehicle_type,
            'main_image' => ENV('APP_URL') . $this->main_image,
            'file_name' => pathinfo($this->main_image, PATHINFO_BASENAME),
            'status' => $this->status,
            'auction_start_date' => $this->auction_start_date,
            'auction_end_date' => $this->auction_end_date,
            'short_description' => $this->short_description,
            'ar_short_description' => $ar_short_description,
            'description' => $this->description,
            'ar_description' => $ar_description,
            'people_are_interested' => $bid_count,
            'my_bid_amount' => $my_bid_amount,
            'height_bid' => !is_null($height_bid) ? $height_bid : 0,
            'day' => $days,
            'hours' => $hours,
            'minute' => $minute,
            'second' => $second,
            'is_wishlist' => $is_wishlist,
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document)
        ];
    }
}
