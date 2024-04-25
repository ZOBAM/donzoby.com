<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "content",
        "approved",
        "parent_id",
    ];

    /**
     * get user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
