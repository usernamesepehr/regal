<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class apply extends Model
{
    protected $guarded = [];
    protected $table = 'applies';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
