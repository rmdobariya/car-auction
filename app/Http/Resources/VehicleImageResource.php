<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => 'https://car-auction.projectdemo.click/' .$this->image,
            'file_name' => pathinfo($this->image, PATHINFO_BASENAME),
        ];
    }
}
