<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//TODO:Make this posts_tags in the migration and model
class article_tags extends Model
{
    protected $hidden = ['post_id','tag_id'];
}
