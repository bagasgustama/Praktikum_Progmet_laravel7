<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = ['discount'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function kurir(){
        return $this->belongsTo(Couriers::class,'courier_id','id');
    }

    public function detail_transaksi(){
        return $this->hasMany(TransactionsDetail::class,'transaction_id','id');
    }

    public function produk(){
        return $this->belongsToMany(Products::class,'transaction_details','transaction_id','product_id');
    }

    public function getimageattribute(){
        return $this->proof_of_payment? asset('storage/img/buktipembayaran/'.$this->proof_of_payment):asset('img-001.jpg');
    }


}
