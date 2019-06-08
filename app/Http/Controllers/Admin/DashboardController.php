<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Workers;
use App\User;
use App\Packages;
use App\PackageOrders;

class DashboardController extends Controller
{
	
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    public function index()
    {
    	$totalWorkers=Workers::count();
    	$totalUsers=User::count();
    	$totalActivePackage=Packages::where('active','y')->count();
    	$totalPackage=Packages::count();
    	$totalOrders=PackageOrders::where('payment_status','done')->count();
    	$totalPendingOrders=PackageOrders::where('status','pending')->where('payment_status','done')->count();
    	
    	return view('dashboard',compact('totalWorkers','totalUsers','totalActivePackage','totalPackage','totalOrders','totalPendingOrders'));
    }
}
