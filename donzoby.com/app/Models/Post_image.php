<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_image extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
    ] ;

    /**
     * get post
     */
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
