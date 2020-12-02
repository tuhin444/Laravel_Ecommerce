<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\District;
use App\Divistion;
use App\Notifications\VerifyRegistration;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



      public function showRegistrationForm()
       {

        $divistions = Divistion::orderBy('id')->get();
        $districts = District::orderBy('name','asc')->get();
        return view('auth.register',compact('divistions','districts'));
       }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => 'required|min:4|unique:users,username',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required','max:14'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'street_address' => ['required'],
            'district_id' => ['required','numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
       $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'street_address' => $request->street_address,
            'divistion_id' => $request->divistion_id,
            'district_id' => $request->district_id,
            'ip_address' => request()->ip(),
            'remember_token'  =>str::random(40),
            'status'  => 0,
        ]);

       

       // $user->notify(new VerifyRegistration($user));
       // session()->flash('success', 'A confirmation email has sent to you.. Please check and confirm your email');
     //  return redirect('{{ route('login') }}');
       return redirect()->route('login');
    }
}
