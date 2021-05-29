<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "response";
    protected $fillable = ['review_id','admin_id','content'];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

}
