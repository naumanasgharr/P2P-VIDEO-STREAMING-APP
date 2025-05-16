<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = "room";
    protected $fillable = [
        'user1_id',
        'user2_id',
        'video_path',
        'room_key',
    ];

    public function messages() {
        return $this->hasMany(Messages::class,'room_id','id');
    }

    public function user1() {
        return $this ->belongsTo(User::class,'user1_id');
    }
    public function user2() {
        return $this ->belongsTo(User::class,'user2_id');
    }
}
