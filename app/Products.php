<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $fillable = ['product_name','price','description','product_rate','stock','weight'];

    public function kategori(){
        return $this->belongsToMany(Categories::class,'product_category_details','product_id','category_id');
    }

    public function productimage(){
        return $this->hasMany(ProductImages::class,'product_id','id');
    }

    public function diskon(){
        return $this->hasMany(Discounts::class, 'id_product','id')->orderBy('id','desc')->limit('1');
    }

    public function cart(){
        return $this->hasMany(Carts::class, 'product_id');
    }

    public function getfirstimage(){
        $image = ProductImages::where('product_id', $this->id)->first();
        return $image;
    }
    public function getdiskon(){
        $diskon = Discounts::where('id_product',$this->id)->where('start','<=',date('Y-m-d'))->where('end','>=',date('Y-m-d'))->first();
        return $diskon;
    }

    public function transaksi(){
        return $this->belongsToMany(Transactions::class,'transaction-details','product_id','transaction_id');
    }

    public function reviewproduk(){
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    
}