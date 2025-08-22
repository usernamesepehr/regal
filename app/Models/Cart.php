<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public static function create_cart($quantity, $product_id, $options_id, $user_id)
    {
        self::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'options_id' => $options_id
        ]);
    }
}
