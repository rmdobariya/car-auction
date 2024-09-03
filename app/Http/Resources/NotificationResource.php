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
            'vehicle_name' => $this->vehicle_name,
            'vehicle_image' => asset($this->vehicle_image),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'question' => $this->question,
            'message' => $this->message,
            'type' => str_replace('_',' ',ucfirst($this->type)),
            'is_read' => $this->is_read,
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_format'))
        ];
    }
}
