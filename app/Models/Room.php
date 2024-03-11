<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
        'available_count',
        'area',
        'hotel_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function media()
    {
        return $this->hasMany(RoomMedia::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
