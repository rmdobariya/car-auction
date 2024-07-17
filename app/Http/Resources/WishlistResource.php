<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class WishlistResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id',$this->wishlist_vehicle_id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id',$this->wishlist_vehicle_id)->get();
        $my_bid_amount = 0;
        $is_wishlist = 0;
        $height_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->wishlist_vehicle_id)->max('amount');
        if (!is_null($request->user())) {
            $my_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->wishlist_vehicle_id)->where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
            if (!is_null($my_bid)) {
                $my_bid_amount = $my_bid->amount;
            }
            $wishlist = DB::table('wish_lists')->where('vehicle_id', $this->wishlist_vehicle_id)->where('user_id', $request->user()->id)->first();
            if (!is_null($wishlist)) {
                $is_wishlist = 1;
            } else {
                $is_wishlist = 0;
            }
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
            'wishlist_id' => $this->wishlist_id,
            'wishlist_vehicle_id' => $this->wishlist_vehicle_id,
            'vehicle_name' => $this->name,
            'vehicle_category_name' => $this->vehicle_category_name,
//            'short_description' => $this->short_description,
            'description' => $this->description,
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
            'height_bid' => !is_null($height_bid) ? $height_bid : 0,
            'my_bid' => $my_bid_amount,
            'is_wishlist' => $is_wishlist,
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
            'created_at' => $this->created_at,
        ];
    }
}
