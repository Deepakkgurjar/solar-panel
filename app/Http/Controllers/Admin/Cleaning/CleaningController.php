<?php

namespace App\Http\Controllers\Admin\Cleaning;
use Auth;
use App\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CleaningController extends Controller
{
    function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}

	function index(){
		$fromValue="";
		$toValue="";
		$cleaningHistory= Tasks::orderby('cleaning_time','desc')->whereNotNull('cleaning_time')->paginate(10);
		// dd(count($cleaningHistory));
		return view('cleaning.historylist',compact('cleaningHistory','fromValue','toValue'));
	}

	function cleaningHistoryFilter(Request $request){

		$fromtime=$request->fromclean;
		$fromtime=substr($fromtime, 0, -3);

		$totime=$request->toclean;
		$totime=substr($totime, 0, -3);
		
		$from = strtotime($fromtime);
		$to=strtotime($totime);

		$fromValue=$request->fromclean;
		$toValue=$request->toclean;

		if(!empty($fromtime) && !empty($totime)){
			
			$cleaningHistory= Tasks::orderby('cleaning_time','desc')->where('cleaning_time','>',$from)->where('cleaning_time','<',$to)->whereNotNull('cleaning_time')->paginate(10);
		// dd(count($cleaningHistory));
		return view('cleaning.historylist',compact('cleaningHistory','fromValue','toValue'));
		}

		if(!empty($fromtime)){
			
			$cleaningHistory= Tasks::orderby('cleaning_time','desc')->where('cleaning_time','>',$from)->whereNotNull('cleaning_time')->paginate(10);
		// dd(count($cleaningHistory));
		return view('cleaning.historylist',compact('cleaningHistory','fromValue','toValue'));
		}

		if(!empty($totime)){
			
			$cleaningHistory= Tasks::orderby('cleaning_time','desc')->where('cleaning_time','<',$to)->whereNotNull('cleaning_time')->paginate(10);
		// dd(count($cleaningHistory));
		return view('cleaning.historylist',compact('cleaningHistory','fromValue','toValue'));
		}

	}
}
