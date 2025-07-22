<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'phone',
        'payment_method',
        'payment_status',
        'payment_transaction_id',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shoes()
    {
        return $this->belongsToMany('App\Models\Shoe')->withPivot('quantity');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
