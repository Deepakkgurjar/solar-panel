<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User ;

class Admin extends User
{
     protected $table = 'admins';
    protected $primaryKey = 'id';
}
