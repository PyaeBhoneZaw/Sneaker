<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function shoes()
    {
        return $this->hasMany('App\Models\Shoe');
    }
}
