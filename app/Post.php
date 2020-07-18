<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    //use Searchable;
    //set a mutator for content
    public function setPostContentAttribute($value)
    {
        $this->attributes['post_content'] = str_replace('<code>','<code data-linenumber=1>',($value));
    }
}
