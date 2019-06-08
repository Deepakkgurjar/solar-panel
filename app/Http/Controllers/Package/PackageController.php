<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Packages;
use App\PackageOrders;

class PackageController extends Controller
{
    

    public function allPackages()
    {
    	$user = Auth::user();

    	 $getAllPackages=Packages::orderby('id','desc')->where('active','y')->get();

        $response['return']=true;
        $response['message']='Package List';
        $response['data']=$getAllPackages;
        return response()->json($response,200);

    }

    public function buyPackage(Request $request)
    {
    	$user = Auth::user();

    	$rules=[
    		'package_id'=>'required|exists:packages,id',
    		'name'=>'required',
    		'date'=>'required',
    		'time_id'=>'required',
    		'address'=>'required',
    		'mobile_no'=>'required',
    		'email_id'=>'required',
    	];
    	
    	$message=[
    		'package_id.required'=>'select package a pacage id',
    		'name.required'=>'Name field is required',
    		'date.required'=>'Date field is required',
    		'time_id.required'=>'time field is required',
    		'address.required'=>'Address field is required',
    		'mobile_no.required'=>'Mobile no field is required',
    		'email_id.required'=>'Email id field is required',
    	];

    	$validator= Validator::make($request->all(),$rules,$message);
    	if($validator->fails()){
    		$response['return'] = false;
    		$response['message'] = "errors";
    		$response['error']=$validator->errors()->toArray();
    		$response['error_key']=array_keys($validator->errors()->toArray());
    		return response()->json($response, 422);
    	}else{
            // for generate a unique order no.--------------------------------
            // $today = date("Ymd");
            // $rand = sprintf("%04d", rand(0,9999));
            // $orderno = $today.$rand;
            // dd($orderno);
            // $previousOrder = PackageOrders::orderby('id','desc')->first();
            // if(!empty($previousOrder)){
            //     $orderno= $previousOrder->order_no + 1;
            // }
            // dd(strtok($orderno,""));
            //-------------------------------------------------------------
            
    		$packageAmount = Packages::where('id',$request->package_id)->first();
    		// dd($packageAmount->prize);
    		$makeOrder = new PackageOrders();
            $makeOrder->user_id=$user->id;
    		$makeOrder->package_id = $request->package_id;
    		$makeOrder->name = $request->name;
    		$makeOrder->service_date = $request->date;
    		$makeOrder->time_slot_id= $request->time_id;
    		$makeOrder->address = $request->address;
    		$makeOrder->mobile_no = $request->mobile_no;
            $makeOrder->email = $request->email_id;
            $makeOrder->status='pending';
    		$makeOrder->amount = $packageAmount->prize;
            // $makeOrder->order_no=strtok($orderno,"");
            $makeOrder->payment_status='pending';
    		$makeOrder->time = time();
    		$makeOrder->save();

    		$response['return'] = true;
    		$response['message']="Sucess";
    		$response['details']=$makeOrder;
    		return response()->json($response, 200);
    	}
    }

    public function saveOrderStatus(Request $request)
    {
        $user = Auth::user();
        //here order no is order_id and payment_id will come after payment success
        $rules=[
            'payment_id'=>'required',
            'order_no'=>'required',
            
        ];
        
        $message=[
            'payment_id.required'=>'payment id required',
            'order_no.required'=>'order_no required',
           
        ];

        $validator= Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $response['return'] = false;
            $response['message'] = "errors";
            $response['error']=$validator->errors()->toArray();
            $response['error_key']=array_keys($validator->errors()->toArray());
            return response()->json($response, 422);
        }else{
            $order = PackageOrders::where('id',$request->order_no)->first();
            $data=[
                'order_no'=>$request->payment_id,
                'payment_status'=>'done',
                'time'=>time(),
            ];

            $data=PackageOrders::where('id',$request->order_no)->update($data);

            // $message='Your Package'.$num_str.'. Keep it confidential.';
            // $number= $getUser->mobile_no;
            // sendMessages($message,$number);
            
            //SEND MESSAGE AFTER SUCCESS PAYMENT 
            $response['return'] = true;
            $response['message']="Sucess";
            $response['details']=$data;
            return response()->json($response, 200);
        }

    }

    
}
