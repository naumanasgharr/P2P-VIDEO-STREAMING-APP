<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'sender_id',
        'room_id',
        'message'
    ];
    public function room() {
        return $this->belongsTo(Room::class,'room_id');
    }
    public function sender() {
        return $this->belongsTo(User::class,'sender_id');
    }
}
