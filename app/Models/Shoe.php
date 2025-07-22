<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'shoe_name',
        'price',
        'stock_quantity',
        'shoe_image',
        'sizes',
        'shoe_model_id'
    ];

    protected $casts = [
        'sizes' => 'array',
        'price' => 'decimal:2'
    ];

    public function shoeModel()
    {
        return $this->belongsTo('App\Models\ShoeModel');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('size');
    }
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
