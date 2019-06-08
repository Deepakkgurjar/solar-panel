<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User ;
use Illuminate\Database\Eloquent\SoftDeletes;
class TimeSlots extends Model
{
	use SoftDeletes;
    protected $table = 'time_slots';
    protected $primaryKey = 'id';

}
