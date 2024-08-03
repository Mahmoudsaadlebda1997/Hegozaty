<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'description',
        'price',
        'status',
    ];


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }
}
