<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleDocumentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'document' => $this->document,
        ];
    }
}
