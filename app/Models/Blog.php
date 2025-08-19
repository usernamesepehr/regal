<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    protected $guarded = [];
    public function comments(): HasMany
    {
        return $this->hasMany(Blog_comment::class);
    }
}
