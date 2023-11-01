<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'vehicle_id' => $this->vehicle_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'question' => $this->question,
            'type' => $this->type,
            'is_read' => $this->is_read,
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_format'))
        ];
    }
}
