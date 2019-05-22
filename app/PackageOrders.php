<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class PackageOrders extends Model
{
	use notifiable;
    protected $table="package_orders";
}
