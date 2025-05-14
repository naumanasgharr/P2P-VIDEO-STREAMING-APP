<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class friendships extends Model
{
    //
    protected $fillable = [
        'user_id',
        'friend_id',
        'accepted'
    ];
}
