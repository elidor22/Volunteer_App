<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $fillable = [
        'post_id', 'title', 'post','cover_url',
    ];
    protected $hidden = ['id','isApproved','created_at', 'updated_at','pendingApproval'];

}
