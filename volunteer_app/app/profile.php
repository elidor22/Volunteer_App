<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = ['id','email','name','surname','username','profile_photo_url'];

    protected $hidden = ['isApproved','created_at', 'updated_at'];
}
