<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_discount extends Model
{
    protected $guarded = [];
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
