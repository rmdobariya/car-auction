<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class WishlistResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id',$this->wishlist_vehicle_id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id',$this->wishlist_vehicle_id)->get();
        return [
            'wishlist_id' => $this->wishlist_id,
            'wishlist_vehicle_id' => $this->wishlist_vehicle_id,
            'vehicle_name' => $this->vehicle_name,
            'short_description' => $this->short_description,
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
            'minimum_bid_increment_price' => $this->minimum_bid_increment_price,
            'mileage' => $this->mileage,
            'type' => $this->type,
            'price' => $this->price,
            'bid_increment' => $this->bid_increment,
            'ratting' => $this->ratting,
            'is_product' => $this->is_product,
            'is_vehicle_type' => $this->is_vehicle_type,
            'main_image' => $this->main_image,
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
