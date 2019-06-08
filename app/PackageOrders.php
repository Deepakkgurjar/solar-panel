<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class PackageOrders extends Model
{
	use notifiable;
    protected $table="package_orders";

    function packageData(){
    	return $this->belongsTo(Packages::class,'package_id','id');
    }

    function userData(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

    function timeSlot(){
    	return $this->belongsTo(TimeSlots::class,'time_slot_id','id');
    }

    function task(){
        return $this->hasOne(Tasks::class, 'order_id', 'id');
    }
}
