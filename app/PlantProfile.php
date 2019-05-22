<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PlantProfile extends Model
{
    use Notifiable;
    protected $table = "plant_profile";
}
