<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ModalHotDealVehicleResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->vehicle_id,
            'name' => $this->vehicle_name,
            'main_image' => 'https://car-auction.projectdemo.click/' . $this->main_image,
            'file_name' => pathinfo($this->main_image, PATHINFO_BASENAME),
        ];
    }
}
