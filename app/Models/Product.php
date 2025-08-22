<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\Hash;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['image'];
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function Wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
    public function quantities(): HasMany
    {
        return $this->hasMany(Quantity::class);
    }
    public function product_discounts(): HasMany
    {
        return $this->hasMany(Product_discount::class);
    }
    public function product_category(): HasMany
    {
        return $this->hasMany(Product_category::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(Product_image::class);
    }
    public function product_metas(): HasMany
    {
        return $this->hasMany(Product_meta::class);
    }
    public function getImageAttribute()
    {
        return $this->images()->first();
    }
}
