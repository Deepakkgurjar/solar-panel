<?php

namespace App\Http\Controllers\Admin\Order;
use App\PackageOrders;
use App\Tasks;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    
    function viewallOrders(){
		$inputs="";
        $alreadyAssign=Tasks::selectRaw('group_concat(order_id) as order_id')->first();
    	$allOrders=PackageOrders::orderby('id','desc')->where('payment_status','done')->paginate(10);
    	// dd($allOrders);
    	return view('orders.list',compact('allOrders','alreadyAssign','inputs'));
    }

    function filterOrderList(Request $request){
        $inputs=$request->all();

        $alreadyAssign=Tasks::selectRaw('group_concat(order_id) as order_id')->first();
        $allOrders=PackageOrders::orderby('id','desc');

        if(!empty($request->order_no)){
            $allOrders=$allOrders->where('id','LIKE','%'.$request->order_no.'%');

        }

        if(!empty($request->mobile)){
            $allOrders=$allOrders->where('mobile_no','LIKE','%'.$request->mobile.'%');
    
        }

        if(!empty($request->bookdate)){
            $allOrders=$allOrders->where(DB::raw('FROM_UNIXTIME(package_orders.time,"%d-%m-%Y")'),'=',$request->bookdate);
        }


        if(!empty($request->serdate)){
            $allOrders=$allOrders->where('service_date',$request->serdate);
        }

        if(!empty($request->address)){
            $allOrders=$allOrders->where('address','like','%'.$request->address.'%');
        }

        if(!empty($request->selector) && $request->selector=='done'){
            $allOrders=$allOrders->where('status','done');
        }

        if(!empty($request->selector)&& $request->selector=='pending'){
            $allOrders=$allOrders->where('status','pending');
        }
        
    
       $allOrders = $allOrders ->where('payment_status','done')->paginate(10);
        return view('orders.list',compact('allOrders','alreadyAssign','inputs'));
    }

    function orderPaymentStatus($order_id){

        
    	$paymentDone=PackageOrders::where('id',$order_id)->first();
    	$data=[
    		'payment_status'=>'done'
    	];
    	PackageOrders::where('id',$order_id)->update($data);
    	return redirect()->back()->with('message','Payment status done');
    }

    function orderStatus($order_id){
         $checkAssignedUser=Tasks::where('order_id',$order_id)->first();

        if(empty($checkAssignedUser)){
            return redirect()->back()->with('error','Order not assigned to any worker');
        }
    	$orderDone=PackageOrders::where('id',$order_id)->first();
    	$data=[
    		'status'=>'done'
    	];
        PackageOrders::where('id',$order_id)->update($data);
        $data=[
            'status'=>'done',
            'cleaning_time'=>time(),
        ];
        Tasks::where('order_id',$order_id)->update($data);
    	
    	return redirect()->back()->with('message','Order status done');
    }
}
