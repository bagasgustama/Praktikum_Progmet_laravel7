<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = "discounts";
    protected $fillable = ['id_product','percentage','start','end'];

    public function produk(){
        return $this->belongsTo(Products::class,'id_product','id');
    }
}