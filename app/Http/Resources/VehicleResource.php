<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class VehicleResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id', $this->id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id', $this->id)->get();
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
            'name' => $this->vehicle_name,
            'user_id' => $this->user_id,
            'vehicle_category_name' => $this->vehicle_category_name,
            'year' => $this->year,
            'make' => $this->make,
            'model' => $this->model,
            'trim' => $this->trim,
            'kms_driven' => $this->kms_driven,
            'owners' => $this->owners,
            'transmission' => $this->transmission,
            'fuel_type' => $this->fuel_type,
            'body_type' => $this->body_type,
            'registration' => $this->registration,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'car_type' => $this->car_type,
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
            'auction_start_time' => $this->auction_start_time,
            'auction_end_time' => $this->auction_end_time,
            'short_description' => $this->short_description,
            'description' => $this->description,
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
