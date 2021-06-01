<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = "discounts";
    protected $fillable = ['product_id','percentage','start','end'];

    public function produk(){
        return $this->belongsTo(Products::class,'id_product','id');
    }
}