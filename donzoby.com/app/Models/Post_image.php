<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_image extends Model
{
    use HasFactory;

    protected $fillable = [
        "post_id",
        "link",
    ];

    /**
     * get post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
