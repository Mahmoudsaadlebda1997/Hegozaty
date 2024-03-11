<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description',
        'image',
        'rating',
        'phone',
        'phone2',
        'email',
        'website',
        'facebook',
        'instagram',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
