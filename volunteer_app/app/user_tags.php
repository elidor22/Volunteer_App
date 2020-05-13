<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_tags extends Model
{
    protected $hidden = ['user_idi','tag_id'];
}
