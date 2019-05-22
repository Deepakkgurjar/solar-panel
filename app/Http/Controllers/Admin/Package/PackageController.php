<?php

namespace App\Http\Controllers\Admin\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Packages;


class PackageController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    public function packageList()
    {
    	
    	$allPackages=Packages::orderby('id','desc')->get();
    	return view('packages.packagelist',compact('allPackages'));
    }

    public function editPackage($package_id)
    {
    	$packageDetail=Packages::where('id',$package_id)->first();
    	return view('packages.editpackage',compact('packageDetail'));
    }
}
