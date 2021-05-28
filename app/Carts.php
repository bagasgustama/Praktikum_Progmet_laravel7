<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = "carts";

    public function produk(){
        return $this->belongsTo(Products::class, 'product_id','id');
    }
}
