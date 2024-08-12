<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'post_origin',
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'children',
        'is_up_to_date',
    ];

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

    /**
     * get is_up_to_date status
     */
    public function getIsUpToDateAttribute()
    {
        $last_post_sync = $this->post_syncs()->latest()->first(); // last sync attempt
        return  $last_post_sync && $last_post_sync->synced;
    }

    /**
     * get post_syncs
     */
    public function post_syncs()
    {
        return $this->hasMany(Post_sync::class);
    }

    /**
     * set content (a temporary solution for cpanel's failure to accept inline style in post)
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => str_replace('xstyle=', 'style=', $value),
        );
    }

    /**
     * set sort value for new post
     */
    protected function sort_value(): Attribute
    {
        return Attribute::make(
            set: fn() => $this->id,
        );
    }
}
