<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User ;
class Tasks extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    function orders(){
    	return $this->belongsTo(PackageOrders::class,'order_id','id');
    }

    function timeslot(){
    	return $this->belongsTo(TimeSlots::class,'time_slot_id','id');
    }

    function worker(){
    	return $this->belongsTo(Workers::class,'worker_id','id');
    }
}
