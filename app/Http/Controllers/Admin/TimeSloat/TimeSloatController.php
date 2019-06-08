<?php

namespace App\Http\Controllers\Admin\TimeSloat;
use App\TimeSlots;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeSloatController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    function viewTimeSloats(){

    	$timeSloat= TimeSlots::orderby('start_time','asc')->get();
    	return view('timesloat.list',compact('timeSloat'));
    }

    function hideSloat($s_id){
    	$checkSloat=TimeSlots::where('id',$s_id)->first();
    	if(!empty($checkSloat)){
    		$data=[
    			'active'=>'n'
    		];
    		TimeSlots::where('id',$s_id)->update($data);
    		return redirect()->back()->with('message','Successfully Time sloat hide');
    	}

    	return redirect()->back()->with('error','Something went wrong.');
    }

    function showSloat($s_id){
    	$checkSloat=TimeSlots::where('id',$s_id)->first();
    	if(!empty($checkSloat)){
    		$data=[
    			'active'=>'y'
    		];
    		TimeSlots::where('id',$s_id)->update($data);
    		return redirect()->back()->with('message','Successfully Time sloat visible');
    	}

    	return redirect()->back()->with('error','Something went wrong.');
    }

    function editTimeSlot(){
    	$timeSloat=TimeSlots::orderby('start_time','asc')->get();

    	return view('timesloat.edit',compact('timeSloat'));
    }

    function slotSave(Request $request){
    	
    	foreach($request->startTime as $key =>$value){
    		
    		$data=[
    			'start_time'=>strtotime($value),
    			'end_time'=>strtotime($request->endTime[$key]),
    			
    		];
    		TimeSlots::where('id',$request->id[$key])->update($data);
    	}
    		
    		return redirect('edit-time-slot')->with('message','Successfully Time Update');
   	
    }

    function deleteTimeSlot($s_id){
        $checkSloat=TimeSlots::where('id',$s_id)->first();
        if(!empty($checkSloat)){
            
            TimeSlots::where('id',$s_id)->delete();
            return redirect()->back()->with('message','Successfully Delete Time Slot');
        }

        return redirect()->back()->with('error','Something went wrong.');
    }

    function addSlot(Request $request){
        
        return view('timesloat.addtime');
    }

    function updateslot(Request $request){
        // dd($request->afterId);
        $startTime=strtotime($request->startTime);
        $endTime=strtotime($request->endTime);
        
        $insert = new TimeSlots();
        $insert->start_time=$startTime;
        $insert->end_time=$endTime;
        $insert->active='y';
        $insert->save();
        
        return redirect('edit-time-slot')->with('message','Successfully Add new Time slot');

    }
}
