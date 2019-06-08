<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\PlantProfile;

class PlantProfileController extends Controller
{

	public function plantProfile(Request $request)
	{
	  	$user = Auth::user();
	  	// $rules=[
        //         'plant_size'=>'required',
        //         'no_of_plants'=>'required',
        //         'roof_type'=>'required',
        //         'water_supply'=>'required',
        //         'plant_befor_img'=>'required',
        //         'plant_after_img'=>'required',


        //     ];
        //     $message=[
        //         'plant_size.required'=>'plant size required',
        //         'no_of_plants.required'=>'number of plants required',
        //         'roof_type.required'=>'roof Type required',
        //         'water_supply.required'=>'water supply available or not',
        //         'plant_befor_img.required'=>'before cleaning plant image required',
        //         'plant_after_img.required'=>'after cleaning plant image required',
        //     ];

        //     $validation = Validator::make($request->all(), $rules);
        //         if ($validation->fails()) {
        //             $response['return'] = false;
        //             $response['message'] = "errors";
        //             $response['error'] = $validation->errors()->toArray();
        //             $response['error_key'] = array_keys($validation->errors()->toArray());
        //             return response()->json($response, 422);

         //         }else{

            	$checkPlant=PlantProfile::where('user_id',$user->id)->first();


            	if(empty($checkPlant)){

            		$plantProfile= new PlantProfile();
	            	$plantProfile->user_id=$user->id;
	            	$plantProfile->plant_size=$request->plant_size;
	            	$plantProfile->no_of_plants=$request->no_of_plants;
	            	$plantProfile->roof_type=$request->roof_type;
	            	$plantProfile->water_supply=$request->water_supply;
                    $plantProfile->time=time();

            	if(!empty($request->plant_befor_img)){
            		$file = $request->file('plant_befor_img');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/userPlantbeforeImages/',$name);
                    $before_img_path = '/storage/images/userPlantbeforeImages/'.$name;
                    $plantProfile->before_img=$before_img_path;

            	}
            	if(!empty($request->plant_after_img)){

            		$file = $request->file('plant_after_img');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/userPlantafterImages/',$name);
                    $after_img_path = '/storage/images/userPlantafterImages/'.$name;
                    $plantProfile->after_img=$after_img_path;
            	}

            	$plantProfile->save();

            	$response['return']=true;
		        $response['message']='Sucessfully update';
		        $response['data']=$plantProfile;
		        return response()->json($response,200);


            }else{

            	if(!empty($request->plant_befor_img)){
            		$file = $request->file('plant_befor_img');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/userPlantbeforeImages/',$name);
                    $before_img_path = '/storage/images/userPlantbeforeImages/'.$name;
                    $checkPlant->before_img=$before_img_path;

            	}
            	if(!empty($request->plant_after_img)){

            		$file = $request->file('plant_after_img');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/userPlantafterImages/',$name);
                    $after_img_path = '/storage/images/userPlantafterImages/'.$name;
                    $checkPlant->after_img=$after_img_path;
            	}
                $checkPlant->save();

            	$response['return']=true;
		        $response['message']='Sucessfully update';
		        $response['data']=$checkPlant;
		        return response()->json($response,200);
            }
        }  

    public function viewPlantProfile(Request $request)
    {
        $user = Auth::user();
        $plantProfile=PlantProfile::where('user_id',$user->id)->first();
        if(empty($plantProfile)){
            $response['return']=true;
            $response['message']='Plant profile not found';
            $response['data']=$plantProfile=NULL;
            return response()->json($response,200);
        }
        $response['return']=true;
        $response['message']='Plant Profile Data';
        $response['data']=$plantProfile;
        return response()->json($response,200);
    }
}

