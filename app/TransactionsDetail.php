<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionsDetail extends Model
{
    protected $table = 'transaction_details';
    protected $guarded = [];

    public function transaksi(){
        return $this->belongsTo(Transactions::class,'transaction_id','id');
    }
    
}
