<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_product extends Model
{
    protected $guarded = [];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
