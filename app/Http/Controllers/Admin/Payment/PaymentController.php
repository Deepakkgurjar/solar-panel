<?php

namespace App\Http\Controllers\Admin\Payment;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Auth;
use App\PackageOrders;

class PaymentController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    public function index(Request $request)
    {	$inputs="";
    	$paymentHistory=PackageOrders::orderby('id','desc')->paginate(10);
    	return view('payment.list',compact('paymentHistory','inputs'));
    }

    public function filterPayment(Request $request)
    {	$inputs= $request->all();
    	// dd($inputs);
    	$paymentHistory=PackageOrders::orderby('id','desc');
    	if(!empty($request->inputord)){
    		$paymentHistory = $paymentHistory->where('id',$request->inputord)->orWhere('id','like','%'.$request->inputord.'%');
    	}

    	if(!empty($request->inputbookdate)){
    		
    		$paymentHistory = $paymentHistory->where(DB::raw('FROM_UNIXTIME(package_orders.time,"%d-%m-%Y")'),'=',$request->inputbookdate);
    	}

    	if(!empty($request->inputserdate)){
    		
    		$paymentHistory = $paymentHistory->where('service_date',$request->inputserdate);
    	}

    	if(!empty($request->inputaddr)){
    		
    		$paymentHistory = $paymentHistory->where('address',$request->inputaddr)->orWhere('address','like','%'.$request->inputaddr.'%');
    	}

    	if(!empty($request->selector) && $request->selector=='done'){
    		
    		$paymentHistory = $paymentHistory->where('payment_status','done');
    	}

    	if(!empty($request->selector) && $request->selector=='pending'){
    		
    		$paymentHistory = $paymentHistory->where('payment_status','pending');
    	}
    	$paymentHistory= $paymentHistory->paginate(10);
    	return view('payment.list',compact('paymentHistory','inputs'));

    }

}
