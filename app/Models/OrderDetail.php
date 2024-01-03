<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'shoe_id',
        'size',
        'total_price',
    ];
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function shoe()
    {
        return $this->belongsTo('App\Models\Shoe');
    }
}
