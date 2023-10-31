<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class VehicleResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id',$this->id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id',$this->id)->get();
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
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document)
        ];
    }
}
