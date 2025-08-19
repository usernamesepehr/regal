<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    protected $guarded = [];
    public function product_discount(): HasMany
    {
        return $this->hasMany(Product_discount::class);
    }
}
