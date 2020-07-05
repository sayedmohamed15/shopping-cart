<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'item_id','user_id','quantity',
    ];

//    public  function user(){
//
//        return $this->belongsTo('App\User');
//    }

    //
}
