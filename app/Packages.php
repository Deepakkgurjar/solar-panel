<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Packages extends Model
{
	use Notifiable;
    protected $table = "packages";
    
}
