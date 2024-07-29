<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_sync extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'post_id',
        'what_changed',
        'synced',
        'sync_attempts'
    ];

    /**
     * cast attributes
     */
    protected function casts(): array
    {
        return [
            'what_changed' => 'array',
        ];
    }

    /* protected function what_changed(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => "implode(',', $value)",
            get: fn (string $value) => explode(',', $value),
        );
    } */

    /**
     * get post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
