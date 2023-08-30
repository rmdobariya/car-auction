<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelHasRole extends Model
{
    protected $guarded = [];

    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
