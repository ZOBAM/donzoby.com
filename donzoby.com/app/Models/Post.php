<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "parent_id",
        "topic",
        "content",
        "status",
        "description",
        "tags",
        "type",
        "subject_id",
        "author_id",
        'comment_status',
        'comment_count',
        'hits',
        'slug',
        'created_at',
        'updated_at',
    ];
    protected $appends = ['children'];

    /**
     * get subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * get post_images
     */
    public function post_images()
    {
        return $this->hasMany(Post_image::class);
    }

    /**
     * get comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * get user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get children
     */
    public function getChildrenAttribute()
    {
        return $this->where('status', 'published')->where("parent_id", $this->id)->get();
    }
}
