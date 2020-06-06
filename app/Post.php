<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //set a mutator for content
    public function setPostContentAttribute($value)
    {
        $this->attributes['post_content'] = str_replace('<code>','<code data-linenumber=1>',($value));
    }
}
