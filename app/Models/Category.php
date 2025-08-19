<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];
    public function product_category(): HasMany
    {
        return $this->hasMany(Product_category::class);
    }
}
