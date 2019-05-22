<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class SignupController extends Controller
{
	// use AuthenticatesUsers;

	// protected $redirectTo = 'dashboard';
	function __construct(){
		$this->middleware('guest:admin')->except('logout');
	}

	public function showLoginForm()
	{
		return view('loginRegister/login');
	}

    public function index(Request $request)
    {
		$this->validate($request,[
	            'email'=>'required|email',
	            'password'=>'required',
	        ]
	   	);
    	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

    		$admin	=  Auth::user();

    		return redirect('dashboard')->with( 'message', 'Sucessfully login');	
    	}

    	return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function forgotPassword(){

    	return view('loginRegister.forgotpassword');
    }

    public function logout()
    {
    	
    	 Auth::guard('admin')->logout();
	    return redirect('/')->with('message','Sucessfully logout');
    }
  
}
