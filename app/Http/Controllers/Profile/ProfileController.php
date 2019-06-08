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
            'full_name'=>'required|string|max:15'
        ];
        $message=[
            'full_name.required'=>'Full name field required'
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
                    'full_name'=>$request->full_name,
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

    public function viewUserProfile(Request $request)
    {
        $user = Auth::user();
        $UserProfile=User::where('id',$user->id)->first();
        $add=explode(',', $UserProfile->address);
        if(!empty($UserProfile->address)){
            $UserProfile['house_no']=$add[0];
            $UserProfile['block_no']=$add[1];
            $UserProfile['lane']=$add[2];
            $UserProfile['land_mark']=$add[3];
            $UserProfile['city']=$add[4];
            $UserProfile['state']=$add[5];
        }else{
            $UserProfile['house_no']=$add[0]=NULL;
            $UserProfile['block_no']=$add[1]=NULL;
            $UserProfile['lane']=$add[2]=NULL;
            $UserProfile['land_mark']=$add[3]=NULL;
            $UserProfile['city']=$add[4]=NULL;
            $UserProfile['state']=$add[5]=NULL;
        }
        // dd($add[0]);

        if(empty($UserProfile)){
            $response['return']=true;
            $response['message']='User profile not found';
            $response['data']=$UserProfile=NULL;
            return response()->json($response,200);
        }
        $response['return']=true;
        $response['message']='User Profile Data';
        $response['data']=$UserProfile;
        return response()->json($response,200);
    }
}
