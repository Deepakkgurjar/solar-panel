<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use App\PackageOrders;
use App\PlantProfile;
use App\Feedback;
class UserController extends Controller
{
    function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}

	function userList(){
		$inputs="";
        
		$getUsers=User::orderby('id','desc')->paginate(10);
		return view('users.list',compact('getUsers','inputs'));
	}

	function filterUserList(Request $request){
		$inputs=$request->all();
        $getUsers=User::orderby('id','desc');

        if(!empty($request->userName)){

        	$getUsers=$getUsers->where('full_name','like','%' .$request->userName. '%');
        }

        if(!empty($request->mobile)){

        	$getUsers=$getUsers->where('mobile_no','like','%' .$request->mobile. '%');
        }

        if(!empty($request->email)){

        	$getUsers=$getUsers->where('email','like','%' .$request->email. '%');
			
        }

         if(!empty($request->address)){

        	$getUsers=$getUsers->where('address','like','%' .$request->address. '%');
			
        }

		$getUsers=$getUsers->paginate(10);
		return view('users.list',compact('getUsers','inputs'));
	}

	function viewUserOrders($user_id){
		
		$inputs = "";
        
		$getUserOrders=PackageOrders::orderby('id','desc')->where('user_id',$user_id)->paginate(10);

		return view('users.ordersList',compact('getUserOrders','inputs'));
	}

	function orderModal(Request $request){
		
		// $getUserOrders=PackageOrders::selectRaw('*,DATE_FORMAT(from_unixtime(time),"%d %M %Y") as bookingTime')->where('id',$request->order_id)->with('packageData','timeSlot')->first();

		$getUserOrders = PackageOrders::query()
            ->leftjoin('time_slots as times','times.id', '=', 'package_orders.time_slot_id')
            ->leftJoin('packages as package','package.id','=','package_orders.package_id')->selectRaw('package_orders.*,FROM_UNIXTIME (package_orders.time,"%d-%M-%Y %I:%i %p") as bookingTime,FROM_UNIXTIME (times.start_time,"%I:%i %p") as startTime, FROM_UNIXTIME (times.end_time,"%I:%i %p") AS endTime, package.package_name as pname')->where('package_orders.id',$request->order_id)->first();
          

		 return json_encode ($getUserOrders);

	}

	function filterUserOrders(Request $request){
		$inputs=$request->all();

		$getUserOrders=PackageOrders::orderby('id','desc');

		if(!empty($request->order_id)){
			$getUserOrders=$getUserOrders->where('id','LIKE','%'.$request->order_id.'%');
		}

		if(!empty($request->serdate)){
			$getUserOrders=$getUserOrders->where('service_date',$request->serdate);

		}

		if(!empty($request->bookdate)){
			$getUserOrders=$getUserOrders->where(DB::raw('FROM_UNIXTIME(package_orders.time,"%d-%m-%Y ")'),'=',$request->bookdate);
		}

		if(!empty($request->selectorPay) && $request->selectorPay=='done'){
			$getUserOrders=$getUserOrders->where('payment_status','done');
		}

		if(!empty($request->selectorPay) && $request->selectorPay=='pending'){
			$getUserOrders=$getUserOrders->where('payment_status','pending');
		}

		if(!empty($request->selectorOrd) && $request->selectorOrd=='done'){
			$getUserOrders=$getUserOrders->where('status','done');
		}

		if(!empty($request->selectorOrd) && $request->selectorOrd=='pending'){
			$getUserOrders=$getUserOrders->where('status','pending');
		}


		$getUserOrders=$getUserOrders->where('user_id',$request->id)->paginate(10);
		return view('users.ordersList',compact('getUserOrders','inputs'));

	}

	function viewPlantProfile($user_id){


		$plantProfile=PlantProfile::where('user_id',$user_id)->first();

		// dd($plantProfile);
		if(empty($plantProfile)){
			return redirect()->back()->with('error','Plant Profile not uptodate');
		}
		
		
            $plantImages= PlantProfile::selectRaw('package_orders.plant_before_img,package_orders.plant_after_img,plant_profile.before_img,plant_profile.after_img')->leftJoin('package_orders',function($join){
            	$join->on('plant_profile.user_id','=','package_orders.user_id');
            })->where('plant_profile.user_id',$user_id)->first();

		


		return view('users.plant_profile',compact('plantProfile','plantImages'));

	}

	function viewFeedback($order_id){
		$feedback=Feedback::where('order_id',$order_id)->first();
		if(empty($feedback)){
			return redirect()->back()->with('error','Feedback not given');
		}
		return view('users.feedbackview',compact('feedback'));
	}
}
