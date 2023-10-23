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
            'model' => $this->model,
            'year' => $this->year,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'main_image' => $this->main_image,
            'status' => $this->status,
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document)
        ];
    }
}
