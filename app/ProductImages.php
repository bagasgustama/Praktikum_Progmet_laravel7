<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = "product_images";
    protected $fillable = ['product_id','image_name'];

    public function produk(){
        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function getimageattribute(){
        return $this->image_name? asset('storage/img/gambarproduk/'.$this->image_name):asset('img-001.jpg');
    }
}

