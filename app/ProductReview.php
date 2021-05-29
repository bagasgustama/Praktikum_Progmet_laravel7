<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = "product_reviews";
    protected $fillable = ['product_id','user_id','rate','content'];

    public function produk(){
        return $this->belongsTo(Products::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function response(){
        return $this->hasMany(Response::class, 'review_id', 'id');
    }

}
