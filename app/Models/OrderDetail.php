<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shoe_id',
        'quantity',
        'price',
        'size',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function shoe()
    {
        return $this->belongsTo('App\Models\Shoe');
    }
}
