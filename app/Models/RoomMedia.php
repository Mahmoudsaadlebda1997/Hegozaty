<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMedia extends Model
{
    protected $fillable = [
        'image',
        'type',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
