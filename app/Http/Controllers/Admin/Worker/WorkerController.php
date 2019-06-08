<?php

namespace App\Http\Controllers\Admin\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Workers;
use App\PackageOrders;
use App\Tasks;
use DB;
class WorkerController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin')->except('logout');
	}
    public function workerList()
    {
        $inputs="";
        
    	$getWorkers=Workers::orderby('id','desc')->paginate(10);

    	return view('workers.list',compact('getWorkers','inputs'));
    }

    public function filterWorker(Request $request)
    {
        $inputs=$request->all();
        $getWorkers=Workers::orderby('id','desc');
       
        if(!empty($request->workerName)){

            $getWorkers=$getWorkers->where('name','like','%'.$request->workerName.'%');
        }

        if(!empty($request->mobile)){

            $getWorkers=$getWorkers->where('mobile','like','%'.$request->mobile.'%');
            
        }

        $getWorkers=$getWorkers->paginate(10);
        return view('workers.list',compact('getWorkers','inputs'));
    }

    public function editWorker($worker_id)
    {
    	$worker=Workers::where('id',$worker_id)->first();
    	return view('workers.edit',compact('worker'));
    }

    public function updateWorker(Request $request)
    {
    	$this->validate($request,[
    		'id'=>'required',
    		'workerName'=>'required',
    		'workerMobile'=>'required',
    	]);

    	$findWorker=Workers::where('id',$request->id)->first();
    	$findWorker->name=$request->workerName;

    	if(!empty($request->workerPhoto)){

            $file = $request->file('workerPhoto');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $file->move("storage/assets/img/workerPhotos/",$filename);
            $photoPath = 'storage/assets/img/workerPhotos/'.$filename;
        	
        	$findWorker->photo=$photoPath;
    	}
    	$findWorker->mobile=$request->workerMobile;
    	$findWorker->save();

    	return redirect('list-workers')->with('message','successfully update');
    }

    public function addWorker()
    {
    	return view('workers.add');
    }

    public function saveWorker(Request $request)
    {
    	$this->validate($request,[
    		'workerName'=>'required',
    		'workerMobile'=>'required|min:11|numeric',
    		'workerPhoto'=>'required',
    	]);

    	$newWorker= new Workers();
    	$newWorker->name=$request->workerName;
    	if(!empty($request->workerPhoto)){

            $file = $request->file('workerPhoto');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $file->move("storage/assets/img/workerPhotos/",$filename);
            $photoPath = 'storage/assets/img/workerPhotos/'.$filename;
        	
        	$newWorker->photo=$photoPath;
    	}

    	$newWorker->mobile=$request->workerMobile;
    	$newWorker->save();

    	return redirect()->back()->with('message','New Worker Sucessfully Add');
    	
    }

    public function OrderstoWorker($worker_id)
    {
        $inputs="";
        
        $workerDetail= Workers::where('id',$worker_id)->first();
        
        $totalworkerOrder=Tasks::where('worker_id',$worker_id)->where('status','done')->count();

        
        $allOrders= PackageOrders::with('task','task.worker')->orderby('id','desc')->where('payment_status','done')->paginate(10);
        // dd($allOrders);
        return view('workers.assignOrderList',compact('allOrders','workerDetail','totalworkerOrder','inputs'));
    }

    public function filterOrdersToWorker(Request $request)
    {
        $inputs=$request->all();
        $worker_id=$request->workerId;

        $workerDetail= Workers::where('id',$worker_id)->first();
        
        $totalworkerOrder=Tasks::where('worker_id',$worker_id)->where('status','done')->count();

        
        $allOrders= PackageOrders::with('task','task.worker')->orderby('id','desc');
        if(!empty($request->order_no)){

            $allOrders= $allOrders->Where('id','like','%'.$request->order_no.'%');
        }

        if(!empty($request->mobile)){

            $allOrders= $allOrders->where('mobile_no','like','%'.$request->mobile.'%');
        }

        if(!empty($request->bookdate)){
            $allOrders= $allOrders->where(DB::raw('FROM_UNIXTIME(package_orders.time,"%d-%m-%Y ")'),'=',$request->bookdate);
        }

        if(!empty($request->serdate)){
            $allOrders= $allOrders->where('service_date',$request->serdate);

        }

        if(!empty($request->address)){

            $allOrders= $allOrders->where('address','like','%'.$request->address.'%');
        }

        if(!empty($request->selectorOrd) && $request->selectorOrd=='done'){
             $allOrders= $allOrders->where('status','done');
        }

        if(!empty($request->selectorOrd) && $request->selectorOrd=='pending'){
             $allOrders= $allOrders->where('status','pending');
        }

        $allOrders=$allOrders->where('payment_status','done')->paginate(10);
        return view('workers.assignOrderList',compact('allOrders','workerDetail','totalworkerOrder','inputs'));
    }

    public function assignOrdertoWorker(Request $request)
    {

        $this->validate($request,[
            'order_id'=>'required|exists:package_orders,id',
            'worker_id'=>'required|exists:workers,id',
            
        ]);

        $checkAlreadyAssigned= Tasks::where('order_id',$request->order_id)->first();
        if(!empty($checkAlreadyAssigned)){
            return redirect()->back()->with('error','Sorry this order already assigned to another worker');
        }

        $assignOrder= new Tasks();
        $assignOrder->worker_id=$request->worker_id;
        $assignOrder->order_id=$request->order_id;
        $assignOrder->status="pending";
        $assignOrder->time=time();
        $assignOrder->save();
        return redirect()->back()->with('message','Order Assign Successfully');

    }

    public function viewWorkerTasks($worker_id)
    {
        $inputs="";
        
        $tasks=Tasks::orderby('id','desc')->where('worker_id',$worker_id)->paginate(10);
        $workerDetail= Workers::where('id',$worker_id)->first();
        $totalworkerOrder=Tasks::where('worker_id',$worker_id)->where('status','done')->count();

        return view('workers.worker_taks_list',compact('tasks','workerDetail','totalworkerOrder','inputs'));
    }

    public function filterAssignedOrder(Request $request)
    {
        $inputs=$request->all();
        
        $worker_id = $request->workerId;

        $workerDetail= Workers::where('id',$worker_id)->first();
        $totalworkerOrder=Tasks::where('worker_id',$worker_id)->where('status','done')->count();

        $tasks=Tasks::orderby('id','desc');

        if(!empty($request->order_id)){
            
            $orderno=DB::select('select GROUP_CONCAT(package_orders.id) as orderId from package_orders  WHERE package_orders.id like "%'.$request->order_id.'%"')[0];
        
            $tasks=$tasks->whereIn('order_id',explode(",", $orderno->orderId));

        }

        if(!empty($request->asDate)){
            
            $tasks=$tasks->where(DB::raw('FROM_UNIXTIME (tasks.time,"%d-%m-%Y")'),'=',$request->asDate);
        }

        if(!empty($request->cdate)){
            
            $tasks=$tasks->where(DB::raw('FROM_UNIXTIME (tasks.cleaning_time,"%d-%m-%Y")'),'=',$request->cdate);
        }

        if(!empty($request->address)){
            
            $orderaddr=DB::select('select GROUP_CONCAT(package_orders.id) as orderaddr from package_orders  WHERE package_orders.address like "%'.$request->address.'%"')[0];
            
            $tasks=$tasks->whereIn('order_id',explode(",", $orderaddr->orderaddr));

        }
        if(!empty($request->selector) && $request->selector=='done'){
            
            $orderstatus=DB::select('select GROUP_CONCAT(package_orders.id) as orderStatus from package_orders  WHERE package_orders.status like "%'.$request->selector.'%"')[0];
            
            $tasks= $tasks->whereIn('order_id',explode(",", $orderstatus->orderStatus));
  
        }

        if(!empty($request->selector) && $request->selector=='pending'){
            
            $orderstatus=DB::select('select GROUP_CONCAT(package_orders.id) as orderStatus from package_orders  WHERE package_orders.status like "%'.$request->selector.'%"')[0];
           
            $tasks= $tasks->whereIn('order_id',explode(",", $orderstatus->orderStatus));
  
        }

         $tasks=$tasks->where('worker_id',$worker_id)->paginate(10);
        
        return view('workers.worker_taks_list',compact('tasks','workerDetail','totalworkerOrder','inputs'));
    }
}
