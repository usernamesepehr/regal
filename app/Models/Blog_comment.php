<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog_comment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'blog_comments';
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public static function create_comment($request, $user_id, $user_name)
    {
        self::create([
            'user_id' => $user_id,
            'name' => $user_name,
            'blog_id' => $request->blog_id,
            'title' => $request->title,
            'content' => $request->content
        ]);
    }
}
