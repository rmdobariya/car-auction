<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class BidResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id',$this->bid_vehicle_id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id',$this->bid_vehicle_id)->get();
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $this->bid_vehicle_id)->count();
        $my_bid_amount = 0;
        $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$this->bid_vehicle_id)->max('amount');
        if (!is_null($request->user())) {
            $my_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->bid_vehicle_id)->where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
            $my_bid_amount = $my_bid->amount;
            $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$this->bid_vehicle_id)->where('user_id',$request->user()->id)->max('amount');
        }
        if (!is_null($this->auction_end_date)){
            $current_date = Carbon::now();
            $end_date = Carbon::createFromFormat('Y-m-d', $this->auction_end_date)->endOfDay();
            $diff = $current_date->diff($end_date);
            $days= $diff->days;
            $hours= $diff->h;
            $minute= $diff->i;
            $second= $diff->s;
        }else{
            $days= 0;
            $hours= 0;
            $minute= 0;
            $second= 0;
        }
        return [
            'bid_id' => $this->bid_id,
            'bid_user_id' => $this->bid_user_id,
            'bid_vehicle_id' => $this->bid_vehicle_id,
            'bid_amount' => $this->bid_amount,
            'vehicle_name' => $this->vehicle_name,
            'vehicle_category_name' => $this->vehicle_category_name,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'user_name' => $this->user_name,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'vehicle_category_id' => $this->vehicle_category_id,
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
            'day' => $days,
            'hours' => $hours,
            'minute' =>  $minute,
            'second' => $second,
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document),
            'status' => $this->status,
            'is_auction_awarded' => $this->is_auction_awarded,
            'auction_start_date' => $this->auction_start_date,
            'auction_end_date' => $this->auction_end_date,
            'people_are_interested' => $bid_count,
            'my_bid_amount' => $my_bid_amount,
            'height_bid' => $height_bid,
            'created_at' => $this->created_at,
        ];
    }
}
