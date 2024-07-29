<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_post extends Model
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
        return $this->hasMany(Test_post_image::class);
    }
}
