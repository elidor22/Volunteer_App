<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_tags extends Model
{
    protected $hidden = ['user_id','tag_id'];
}
