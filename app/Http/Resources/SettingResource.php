<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'setting_key' => $this->setting_key,
            'setting_value' => $this->setting_value,
        ];
    }
}
