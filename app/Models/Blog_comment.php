<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog_comment extends Model
{
    protected $guarded = [];
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
