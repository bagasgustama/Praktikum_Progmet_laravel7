<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "product_categories";
    protected $fillable = ['category_name'];

    public function produk(){
        return $this->belongsToMany(Categories::class,'product_category_details','category_id','product_id');
    }
}
