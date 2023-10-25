<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'image' => ENV('APP_URL') .$this->image,
        ];
    }
}
