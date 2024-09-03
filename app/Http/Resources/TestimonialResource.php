<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'role' => $this->role,
            'description' => $this->description,
            'image' => 'https://car-auction.projectdemo.click/' . $this->image,
        ];
    }
}
