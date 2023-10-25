<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageStringResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'app_or_panel' => $this->app_or_panel,
            'name_key' => $this->name_key,
            'name' => $this->name,
        ];
    }
}
