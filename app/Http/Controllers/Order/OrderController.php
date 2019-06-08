<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Feedback;
use App\PackageOrders;
use App\TimeSlots;
use DB;

class OrderController extends Controller
{
    public function myOrdersList()
    {
    	$user = Auth::user();

    	$myOrders=PackageOrders::orderby('service_date','desc')->where('user_id',$user->id)->get();

    	// dd(count($myOrders));


    	if(count($myOrders) > 0 ){

    		$response['return']=true;
    		$response['message']="All Orders";
    		$response['data']=$myOrders;
    		return response()->json($response, 200);
    		
    	}

    	   $response['return']=true;
    		$response['message']="No Orders";
            $response['data']=$myOrders;
    		return response()->json($response, 200);
    	
    }

    public function orderSummary(Request $request)
    {
        $user = Auth::user();

        $rules=[
            'order_id'=>'required|exists:package_orders,id'
        ];

        $message=[
            'order_id.required'=>'order id required'
        ];

        $validator= Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $response['return']=false;
            $response['message']="errors";
            $response['error']=$validator->errors()->toArray();
            $response['error_key']=array_keys($validator->errors()->toArray());
            return response()->json($response,422);
        }else{

            $results = PackageOrders::query()
            ->leftjoin('time_slots as times','times.id', '=', 'package_orders.time_slot_id')->selectRaw('package_orders.*,FROM_UNIXTIME (times.start_time,"%I:%i %p") as startTime, FROM_UNIXTIME (times.end_time,"%I:%i %p") AS endTime')->where('package_orders.id',$request->order_id)->first();

            if(!empty($results)){
            $response['return']=true;
            $response['message']="Order Summary";
            $response['data']=$results;
            return response()->json($response, 200);
            
            }else{
                $response['return']=true;
                $response['message']="Order Not found";
                $response['data']=$results;
                return response()->json($response, 200);

            }

        }   

    }

    public function orderFeedback(Request $request)
    {
        $user = Auth::user();

        $rules=[
            'order_id'=>'required|exists:package_orders,id',
            'satisfied'=>'required',
            'how_like'=>'required',
            'message'=>'required'
        ];

        $message=[
            'order_id.required'=>'order id required',
            'satisfied.required'=>'choos between Terrible to Great',
            'how_like.required'=>'how much like most ',
            'message.required'=>'right about service'
        ];

        $validator= Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $response['return']=false;
            $response['message']="errors";
            $response['error']=$validator->errors()->toArray();
            $response['error_key']=array_keys($validator->errors()->toArray());
            return response()->json($response,422);
        }else{

            $giveFeedback= new Feedback();

            $giveFeedback->order_id=$request->order_id;
            $giveFeedback->user_id=$user->id;
            $giveFeedback->satisfied=$request->satisfied;
            $giveFeedback->how_like=$request->how_like;
            $giveFeedback->message=$request->message;
            $giveFeedback->time=time();
            $giveFeedback->save();

            $response['return']=true;
            $response['message']="Feedback";
            $response['data']=$giveFeedback;
            return response()->json($response, 200);


        }
    }

    public function getTimesSloats(Request $request)
    {


         $rules=[
            'date'=>'required',
            
        ];

        $message=[
            'date.required'=>'date field required',
            
        ];

        $validator= Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $response['return']=false;
            $response['message']="errors";
            $response['error']=$validator->errors()->toArray();
            $response['error_key']=array_keys($validator->errors()->toArray());
            return response()->json($response,422);
        }else{

    
            $getSlotOrder=DB::select("select group_concat(abc) as time from (select group_concat(distinct(time_slot_id)) as abc from package_orders where service_date = '".$request->date."' group by time_slot_id having COUNT(time_slot_id) > 5 ) as a ")[0];

            // dd($getSlotOrder->time);

            $TimeSlot=TimeSlots::selectRaw('id, FROM_UNIXTIME (start_time,"%I:%i %p") as startTime, FROM_UNIXTIME (end_time,"%I:%i %p") AS endTime')->whereNotIn('id',explode(",", $getSlotOrder->time))->get();

            

            $response['return']=true;
            $response['message']="Pick Time Sloat";
            $response['data']=$TimeSlot;
            
            return response()->json($response, 200);
        }
        
    }
}
