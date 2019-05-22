<?php

namespace App\Http\Controllers;

use App\ForgotPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Packages;
use App\PackageOrders;


class HomeController extends Controller
{
//for registration as a user
    public function registerUser(Request $request){

        $rules =[
          'name'=>'required|max:250',
            'mobile'=>'required|min:11|numeric|unique:users,mobile_no',
            'password'=>'required',
        ];
        $message=[
            'name.required'=>'Name field is required',
            'mobile.required'=>'Mobile no field is required',
            'password.required'=>'Password field is required'
        ];

        $validator=Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            $response['return'] = false;
            $response['message']="errors";
            $response['errors']=$validator->errors()->toArray();
            $response['error_key']=array_keys($validator->errors()->toArray());
            return response()->json($response,422);
        }else{
            $userRegister= new User();
            $userRegister->full_name=$request->name;
            $userRegister->mobile_no=$request->mobile;
            $userRegister->password=bcrypt($request->password);
            $userRegister->api_token= sha1(time());
            $userRegister->time=time();
            $userRegister->save();
        }
        if (!empty($userRegister)) {
            $response['return'] = true;
            $response['message']="$userRegister->name Sucessfully register";
            $response['userdata']=$userRegister;
            return response()->json($response,200);
        }
    }

//for Login as a user
    public function loginUser(Request $request){
        $rules=[
            'mobile'=>'required|min:11|numeric',
            'password'=>'required'
        ];
        $message=[
            'mobile.required'=>'Mobile no field is required',
            'password.required'=>'Password field is required',
        ];
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            $response['return'] = false;
            $response['message']="errors";
            $response['errors']=$validation->errors()->toArray();
            $response['error_key']=array_keys($validation->errors()->toArray());
            return response()->json($response,422);
        }else{
            $getUser=User::where('mobile_no',$request->mobile)->first();
            if(empty($getUser)){
                    $response['return'] = false;
                    $response['message']="errors";
                    $response['errors']=['mobile' => ['Invalid mobile no']];
                    $response['error_key']=['mobile'];
                    return response()->json($response, 400);
            }
                if(Auth::attempt(['mobile_no'=>$request->mobile,'password'=>$request->password])) {
                    $response['return'] = true;
                    $response['message'] = "Sucessfully login " . $getUser->name . "";
                    $response['data'] = $getUser;
                    return response()->json($response, 200);
                }else{
                    $response['return'] = false;
                    $response['message']="errors";
                    $response['errors']=['password' => ['Please confirm your password']];
                    $response['error_key']=['password'];

                    return response()->json($response, 400);
                }

        }
    }

//for forgot password as a user threw this function send OTP on registered mobile Number
    public function forgotPassword(Request $request){

        $rules=[
            'mobile'=>'required|min:11|numeric'
        ];
        $messages=[
            'mobile.required'=>'Mobile number field is required'
        ];

        $validation=Validator::make($request->all(),$rules,$messages);
        if($validation->fails()){
            $response['return']=false;
            $response['message']='errors';
            $response['errors']=$validation->errors()->toArray();
            $response['error_key']=array_keys($validation->errors()->toArray());
            return response()->json($response,422);
        }else{
            $getUser=User::where('mobile_no',$request->mobile)->first();



            if(empty($getUser)){
                $response['return']=false;
                $response['message']="errors";
                $response['errors']=['mobile' => ['Incorrect Mobile number']];
                $response['error_key']=['mobile'];
                
                return response()->json($response,400);
            }

            $num_str = sprintf("%04d", mt_rand(1, 9999));

            $alreadyhaveotp=ForgotPassword::where('mobile',$getUser->mobile)->first();

            if (!empty($alreadyhaveotp)){
                ForgotPassword::where('mobile',$getUser->mobile)->delete();
            }

            $otpSave=new ForgotPassword();
            $otpSave->mobile=$getUser->mobile_no;
            $otpSave->otp=$num_str;
            $otpSave->time=time();
            $otpSave->save();

            $message='Your OTP is '.$num_str.'. Keep it confidential.';
            $number= $getUser->mobile_no;
            sendMessages($message,$number);
            $response['return']=true;
            $response['message']='OTP has been send sucessfully';
            return response()->json($response,200);
        }
    }


    public function vefifyOTP(Request $request)
    {

        $rules=[
            'otp'=>'required|numeric',
            'mobile'=>'required|min:10|numeric',
            
        ];
        $message=[
            'otp.required'=>'OTP field is required',
           'mobile.required'=>'Mobile number field is required',
            
        ];
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            $response['return']=false;
            $response['message']='errors';
            $response['errors']=$validation->errors()->toArray();
            $response['error_key']=array_keys($validation->errors()->toArray());
            return response()->json($response,422);
        }else{
            $checkOTP=ForgotPassword::orderby('id','desc')->where('mobile',$request->mobile)->first();
            // dd($checkOTP);
            if ($checkOTP== null){
                $response['return']=false;
                $response['message']="errors";
                $response['errors']=['mobile' => ['Mobile no not match']];
                $response['error_key']=['mobile'];
                return response()->json($response,400);
            }

            if(!empty($checkOTP) &&  $checkOTP->otp == $request->otp){
                $response['return']=true;
                $response['message']='otp  sucessfully match';
                return response()->json($response,200);
            }else{
                $response['return']=false;
                $response['message']="errors";
                $response['errors']=['otp' => ['Incorrect OTP']];
                $response['error_key']=['otp'];
                return response()->json($response,400);
            }

        }
        
    }
//for reset password with you otp
    public function resetPassword(Request $request){

        $rules=[
          
            'mobile'=>'required|min:10|numeric',
            'password'=>'required'
        ];
        $message=[
           
           'mobile.required'=>'Mobile number field is required',
            'password.required'=>'Password field is required'
        ];
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            $response['return']=false;
            $response['message']='errors';
            $response['errors']=$validation->errors()->toArray();
            $response['error_key']=array_keys($validation->errors()->toArray());
            return response()->json($response,422);
        }else{
            $checkOTP=ForgotPassword::where('mobile',$request->mobile)->first();

            if ($checkOTP== null){
                $response['return']=false;
                $response['message']="errors";
                $response['errors']=['mobile' => ['Mobile no not match']];
                $response['error_key']=['mobile'];
                return response()->json($response,400);
            }

            if(!empty($checkOTP) && $checkOTP->mobile == $request->mobile){

                $data=[
                    'password'=>bcrypt($request->password)
                ];
                User::where('mobile_no',$request->mobile)->update($data);
                ForgotPassword::where('mobile',$request->mobile)->delete();
                $response['return']=true;
                $response['message']='Password change sucessfully';
                return response()->json($response,200);
            }else{
                $response['return']=false;
                $response['message']="errors";
                $response['errors']=['otp' => ['Something went wrong']];
                $response['error_key']=['otp'];
                return response()->json($response,400);
            }
        }
    }

    public function dashboard(Request $request)
    {
         $user = Auth::user();
         // dd($user);
         $allPackages=Packages::orderby('id','desc')->get();
         $recentService=PackageOrders::orderby('id','desc')->where('user_id',$user->id)->get();

         $response['return']=true;
        $response['message']='Home';
        $response['Packages']=$allPackages;
        $response['Recent Service']=$recentService;

        return response()->json($response,200);

        
    }


}
