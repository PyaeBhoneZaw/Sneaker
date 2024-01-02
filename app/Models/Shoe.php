<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;
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
}
