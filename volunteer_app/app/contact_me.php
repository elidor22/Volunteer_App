<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_me extends Model
{
    protected $fillable = ['id','email','name','surname','phoneNumber','Feedback', 'contactYou', 'contacted'];

    protected $hidden = ['created_at', 'updated_at'];
}
