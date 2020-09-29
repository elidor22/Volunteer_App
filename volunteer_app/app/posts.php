<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $fillable = ['id',
        'post_id', 'title', 'post','header','cover_url','created_at'];
    protected $hidden = ['isApproved', 'updated_at','pendingApproval'];

}
