<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;
    public function shoeModel()
    {
        return $this->hasMany('App\Models\ShoeModel');
    }
}
