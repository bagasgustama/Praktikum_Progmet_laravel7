<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    // function diskon(){
    //     return $this->hasMany('App\Models\Discount', 'id_product');
    // }

    // function review(){
    //     return $this->hasMany('App\Models\Product_review', 'product_id');
    // }

    // function gambar(){
    //     return $this->hasOne('App\Models\Product_image', 'product_id');
    // }
}
