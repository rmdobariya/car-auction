<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => ENV('APP_URL') . $this->image,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
