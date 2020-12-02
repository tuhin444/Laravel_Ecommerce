<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Divistion;
use App\User;
use Auth;

class UsersController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


   public function dashboard(){

   	 $user = Auth::user();

   	return view('frontend.pages.user.dashboard',compact('user'));
   }
    

   public function profile(){

      $divistions = Divistion::orderBy('id')->get();
      $districts = District::orderBy('name','asc')->get();
      $user = Auth::user();
    return view('frontend.pages.user.profile',compact('user','divistions','districts'));
   }


     public function profileUpdate(Request $request){

        $user = Auth::user();

        $this->validate($request, [
              'first_name' => 'required|string|max:30',
              'last_name' => 'nullable|string|max:15',
              'username' => 'required|alpha_dash|max:100|unique:users,username,'.$user->id,
              'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
           
              'district_id' => 'required|numeric',
              'phone_no' => 'required|max:15|unique:users,phone_no,'.$user->id,
              'street_address' => 'required|max:100',
    ]);

              $user->first_name = $request->first_name;
              $user->last_name = $request->last_name;
              $user->username = $request->username;
              $user->email = $request->email;
              $user->divistion_id = $request->divistion_id;
              $user->district_id = $request->district_id;
              $user->phone_no = $request->phone_no;
              $user->street_address = $request->street_address;
              $user->shipping_address = $request->shipping_address;

              // if ($request->password != NULL || $request->password != "") {
              //   $user->password = Hash::make($request->password);
              // }

              $user->ip_address = request()->ip();
              $user->save();

              session()->flash('success', 'User profile has updated successfuly !!');
              return back();
                
               }



}
