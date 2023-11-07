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
        $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$this->id)->max('amount');
        if (!is_null($request->user())) {
            $my_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
            $my_bid_amount = $my_bid->amount;
            $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$this->id)->where('user_id',$request->user()->id)->max('amount');
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
            'id' => $this->id,
            'name' => $this->vehicle_name,
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
            'status' => $this->status,
            'auction_start_date' => $this->auction_start_date,
            'auction_end_date' => $this->auction_end_date,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'people_are_interested' => $bid_count,
            'my_bid_amount' => $my_bid_amount,
            'height_bid' => !is_null($height_bid) ? $height_bid : 0,
            'day' => $days,
            'hours' => $hours,
            'minute' =>  $minute,
            'second' => $second,
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document)
        ];
    }
}
