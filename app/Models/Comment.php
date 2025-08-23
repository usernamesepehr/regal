<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public static function create_comment($request, $user_id, $user_name)
    {
        self::create([
            'user_id' => $user_id,
            'name' => $user_name,
            'product_id' => $request->product_id,
            'title' => $request->title,
            'content' => $request->content
        ]);
    }
}
