<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'orderDate',
        'price',
        'quantity',
        'payment_type',
    ];
    use HasFactory;

    public function shoes()
    {
        return $this->belongsToMany('App\Models\Shoe')->withPivot('quantity');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
