<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\States;
use App\Cities;

class ProfileController extends Controller
{
    public function updateProfile(Request $request){
        $user = Auth::user();

        $rules=[
            'first_name'=>'required|string|max:15'
        ];
        $message=[
            'first_name.required'=>'First name field required'
        ];

        $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $response['return'] = false;
                $response['message'] = "errors";
                $response['error'] = $validation->errors()->toArray();
                $response['error_key'] = array_keys($validation->errors()->toArray());
                return response()->json($response, 422);

            }else{

                $data=[
                    'full_name'=>$request->first_name,
                ];
                User::where('mobile_no',$user->mobile_no)->update($data);
            }


        if(!empty($request->email)) {

            $rules = [
                'email' => 'required|email|max:255'
            ];

            
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $response['return'] = false;
                $response['message'] = "errors";
                $response['error'] = $validation->errors()->toArray();
                $response['error_key'] = array_keys($validation->errors()->toArray());
                return response()->json($response, 422);
            } else {

                $data=[
                    'email'=>$request->email,
                ];
                User::where('mobile_no',$user->mobile_no)->update($data);

                $response['return']=true;
                $response['message']='Sucessfully update';
                $response['data']=$user;
                return response()->json($response,200);
            }
        }

        if(!empty($request->address_type)){
            $rules = [
                'address_type' => 'required',
                'house_no'=>'required',
                'block_no'=>'required',
                'lane'=>'required',
                'land_mark'=>'required',
                'city'=>'required',
                'state'=>'required',

            ];

            $message=[
                'address_type.required'=>'select address _type',
                'house_no.required'=>'house no is required',
                'block_no.required'=>'block_no is required',
                'lane.required'=>'lane is required',
                'land_mark.required'=>'land_mark is required',
                'city.required'=>'select city',
                'state.required'=>'select state',
            ];
                $validation = Validator::make($request->all(), $rules,$message);
                    if ($validation->fails()) {
                        $response['return'] = false;
                        $response['message'] = "errors";
                        $response['error'] = $validation->errors()->toArray();
                        $response['error_key'] = array_keys($validation->errors()->toArray());
                        return response()->json($response, 422);
                    } else {

                        $address =  ''.$request->house_no.','.$request->block_no.','.$request->lane.','.$request->land_mark.','.$request->city.','.$request->state.'';

                        // dd($address);

                        $data=[
                            'address_type'=>$request->address_type,
                            'address'=>$address
                        ];
                            User::where('mobile_no',$user->mobile_no)->update($data);
                        
                    }
        }


        if(!empty($request->document)){

            $rules = [
                'document' => 'required|mimes:pdf,jpg,jpeg,png'
            ];
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $response['return'] = false;
                $response['message'] = "errors";
                $response['error'] = $validation->errors()->toArray();
                $response['error_key'] = array_keys($validation->errors()->toArray());
                return response()->json($response, 422);
            } else {


                if(!empty($request->document)){
                    $file = $request->file('document');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/userIdentity/',$name);
                    $userIdentityDoc = '/storage/images/userIdentity/'.$name;
                }
                $data=[
                    'document'=>$userIdentityDoc
                ];

                User::where('mobile_no',$user->mobile_no)->update($data);
                
            }
        }

        if(!empty($request->profile_img)){

            $rules = [
                'profile_img' => 'required|mimes:pdf,jpg,jpeg,png'
            ];

            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $response['return'] = false;
                $response['message'] = "errors";
                $response['error'] = $validation->errors()->toArray();
                $response['error_key'] = array_keys($validation->errors()->toArray());
                return response()->json($response, 422);
            } else {

                if(!empty($request->profile_img)){
                    $file = $request->file('profile_img');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/storage/images/profile_image/',$name);
                    $userProfileImg = '/storage/images/profile_image/'.$name;
                }
                $data=[
                    'profile_img'=>$userProfileImg
                ];

                User::where('mobile_no',$user->mobile_no)->update($data);
                
            }



        }
        $id=Auth::user()->id;
        $data=User::where('id',$id)->first();
        $response['return']=true;
        $response['message']='Sucessfully update';
        $response['data']=$data;
        return response()->json($response,200);

    }

    public function allStates(Request $request)
    {
        $user = Auth::user();

        $states=States::get();

        $response['return']=true;
        $response['message']='All Statess';
        $response['data']=$states;
        return response()->json($response,200);
    }

    public function stateCities(Request $request)
    {
        $user = Auth::user();

        $rules=[
            'state_id'=>'required'
        ];
        $message=[
            'state_id.required'=>'Select State Name'
        ];

        $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                $response['return'] = false;
                $response['message'] = "errors";
                $response['error'] = $validation->errors()->toArray();
                $response['error_key'] = array_keys($validation->errors()->toArray());
                return response()->json($response, 422);

            }else{

                $cities=Cities::where('state_id',$request->state_id)->get();
                $response['return']=true;
                $response['message']='All Statess';
                $response['data']=$cities;
                return response()->json($response,200);

            }
    }
}
