<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class States extends Model
{
    use notifiable;
    protected $table="states";
}
