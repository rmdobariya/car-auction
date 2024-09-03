<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleDocumentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'document' => 'https://car-auction.projectdemo.click/' .$this->document,
            'file_name' => pathinfo($this->document, PATHINFO_BASENAME),
        ];
    }
}
