<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cities extends Model
{
    use notifiable;
    protected $table="cities";
}
