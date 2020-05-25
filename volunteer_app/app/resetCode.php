<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resetCode extends Model
{
    protected $table = 'resetCode';
    protected $fillable = ['email', 'code'];
    protected $hidden=['id','created_at','updated_at'];
}
