<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feedback extends Model
{
    use notifiable;
    protected $table="feedbacks";
    
    function userData(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

    function orderData(){
    	return $this->belongsTo(PackageOrders::class,'order_id','id');
    }
}
