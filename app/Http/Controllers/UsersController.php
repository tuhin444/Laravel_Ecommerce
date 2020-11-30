<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function userLoginRegister(){
    	return view('frontend.users.login_register');
    }

    public function register(Request $request){
        if ($request->isMethod('post')) {
        	$data = $request->all();
        	//echo "<pre>";print_r($data);die;
        	$userCount = User::where('email',$data['email'])->count();
        	if($userCount>0){
        		return redirect ()->back()->with('flash_message_error','Email is already exist');
        	}else{
        		$user = New User;
        		$user->name = $data['name'];
        		$user->email = $data['email'];
        		$user->password = bcrypt($data['password']);
        		$user->save();
        		if (Auth::attempt(['email' => $data['email'],'password'=>$data['password']])) {
        			Session::put('frontSession',$data['email']);
        			 return redirect('/cart');
        		}
        	}
        }
    }
    public function logout(){
    	Session::put('frontSession');
    	Auth::logout();
    	return redirect('/');
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {
        	$data = $request->all();
        	//echo "<pre>";print_r($data);die;
        	if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
        	   Session::put('frontSession',$data['email']);
        	   return redirect('/cart');
        	}else{
        		return redirect()->back()->with('flash_message_error','Invalid Username Or Password');
        	}
        }
    }

    public function account(){
    	return view('frontend.users.account');
    }

    public function changePassword(Request $request){
                if ($request->isMethod('post') ) {
                	$data = $request->all();
                	$old_pwd = User::where('id',Auth::User()->id)->first();
                	$current_password = $data['current_password'];
                   if (Hash::check($current_password,$old_pwd->password)) {
                		$new_pwd = bcrypt($data['new_pwd']);
                		 User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                		return redirect()->back()->with('flash_message_error','Yours Password is Changed Now!');
                	}else{
                		return redirect()->back()->with('flash_message_error','Old password incorrect');
                	}	
                }
           return view('frontend.users.change_password');    
    }

    public function changeAddress(Request $request){
    	   $user_id = Auth::user()->id;
    	   $userDetails = Auth::user('user_id');
    	  // echo "<pre>";print_r($userDetails);die;
    	     if($request->isMethod('post')){
        $data = $request->all();
        $user = User::find($user_id);
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->pincode = $data['pincode'];
        $user->mobile = $data['mobile'];
        $user->save();
        return redirect()->back()->with('flash_message_success','Account Details Has Been Updated!');
        
    }
    	  $countries=Country::get();

    	  //dd($countries);
          return view('frontend.users.change_address',compact('countries','userDetails'));
    }
}
