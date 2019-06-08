<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VerifiedUser extends Model
{
    use SoftDeletes;
    protected $table = 'verified_user';
    protected $primaryKey = 'id';
}
