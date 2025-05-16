<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    //
    protected $fillable = [
        'user_id',
        'video_path',
        'room_key',
    ];
}
