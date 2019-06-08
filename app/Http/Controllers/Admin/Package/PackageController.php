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
    	$inputs="";
       
    	$allPackages=Packages::orderby('id','desc')->paginate(10);
    	return view('packages.packagelist',compact('allPackages','inputs'));
    }

    public function editPackage($package_id)
    {
    	$packageDetail=Packages::where('id',$package_id)->first();
    	return view('packages.editpackage',compact('packageDetail'));
    }

    public function updatePackage(Request $request)
    {
        $this->validate($request,[
                'id'=>'required',
                'packageName'=>'required',
                'packageType'=>'required',
                'panelCapacity'=>'required',
                'prize'=>'required',
                'gst'=>'required',
            ]
        );

        $package=Packages::where('id',$request->id)->first();
        $package->package_name=$request->packageName;
        $package->package_type=$request->packageType;
        $package->panel_capacity=$request->panelCapacity;
        $package->prize=$request->prize;
        $package->gst=$request->gst;
        $package->save();
        return redirect('list-packages')->with( 'message', 'Sucessfully Update');
    }

    public function addPackage()
    {
       return view('packages.addpackage');
    }

    public function savePackage(Request $request)
    {
        $this->validate($request,[
                'packageName'=>'required',
                'packageType'=>'required',
                'panelCapacity'=>'required',
                'prize'=>'required',
                'gst'=>'required',
            ]
        );

        $newPackage= new Packages();
        $newPackage->package_name=$request->packageName;
        $newPackage->package_type=$request->packageType;
        $newPackage->panel_capacity=$request->panelCapacity;
        $newPackage->prize=$request->prize;
        $newPackage->gst=$request->gst;
        $newPackage->time=time();
        $newPackage->save();

        return redirect()->back()->with( 'message', 'New Package Sucessfully Add');
    }

    public function packageActivation($package_id)
    {
        $package=Packages::where('id',$package_id)->first();
        if($package->active=='y'){
            $data=[
                'active'=>'n'
            ];

            Packages::where('id',$package_id)->update($data);
            return redirect()->back()->with('message','Successfully Deactive Package');


        }elseif ($package->active=='n') {
            $data=[
                'active'=>'y'
            ];
             Packages::where('id',$package_id)->update($data);
             return redirect()->back()->with('message','Successfully Active Package');
        }
    }

    public function filterPackages(Request $request)
    {   
       
       $inputs=$request->all();
       $allPackages=Packages::orderby('id','desc');

       if(!empty($request->pName)){
        $allPackages=$allPackages->where('package_name', 'like', '%' .$request->pName. '%');
        
       }

       if(!empty($request->pType)){
        $allPackages=$allPackages->where('package_type', 'like', '%' .$request->pType. '%');
        
       }

       if(!empty($request->pPrize)){
        $allPackages=$allPackages->where('prize',$request->pPrize);
        
       }
        $allPackages=$allPackages->paginate(10);

        return view('packages.packagelist',compact('allPackages','inputs'));
    }
}
