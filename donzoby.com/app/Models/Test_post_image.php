<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_post_image extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
    ];
}
