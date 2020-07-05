<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $fillable = ['id',
        'post_id', 'title', 'post','cover_url',
    ];
    protected $hidden = ['isApproved','created_at', 'updated_at','pendingApproval'];

}
