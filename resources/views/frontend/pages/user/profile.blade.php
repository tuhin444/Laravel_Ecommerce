@extends('frontend.layouts.master')

@section('content')



<div id="contact-page" class="container">
<div class="bg" style="margin-left: 185px;
margin-right: 114px;">
<div class="row">    		
<div class="col-sm-12">    			   			
	<h2 class="title text-center">My <strong>Profile</strong></h2>    			    				    				
	
</div>			 		
</div>    	
<div class="row">  	
<div class="col-sm-12 >
<div class="contact-form">
	
	<div class="status alert alert-success" style="display: none"></div>
	@if ($errors->any())
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <ul>
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endif

@if (Session::has('success'))
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-success mt-1">
          <p>{{ Session::get('success') }}</p>
        </div>
      </div>
    </div>
  </div>
@endif

@if (Session::has('sticky_error'))
  <div class="container mt-1">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-danger">
          <p>{{ Session::get('sticky_error') }}</p>
        </div>
      </div>
    </div>
  </div>
@endif


	<form  class="contact-form row" action="{{route('user.profile.update')}}" method="POST">
    @csrf
        <div class="form-group col-md-12">
           
            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->first_name }}" required autofocus placeholder= "Your First Name">
             @if ($errors->has('first_name'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('first_name') }}</strong>
                </span>
              @endif
        </div>


         <div class="form-group col-md-12">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" placeholder="Your Last Name" required autocomplete="last_name" autofocus>

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
           
        </div>

          <div class="form-group col-md-12">
            
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$user->username}}" placeholder="Your Username" required autocomplete="username" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
         </div>


          <div class="form-group col-md-12">
            
           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" name="email" value="{{ $user->email }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>


          <div class="form-group col-md-12">
            
            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{$user->phone_no }}" placeholder="Your phon Number" required autocomplete="phone_no" autofocus>

            @error('phone_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>

        


         <div class="form-group col-md-12">
            
           <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" placeholder="Your Street Address" name="street_address" value="{{ $user->street_address }}" required autocomplete="street_address" autofocus>

            @error('street_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>

          <div class="form-group col-md-12">
            
            <select class="form-control" name="divistion_id">
              <option value="">Please Select Divistion </option>
              @foreach($divistions as $divistion)
                 <option value="{{$divistion->id}}" {{$divistion->id == $user->divistion_id ? 'selected':''}}>{{$divistion->name}}</option>
              @endforeach

              </select>

            @error('divistion_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>

          <div class="form-group col-md-12">
           <select class="form-control" name="district_id">
              <option value="">Please Select District </option>
              @foreach($districts as $district)
                 <option value="{{$district->id}}" {{ $district->id == $user->district_id ? 'selected' : ''}}>{{$district->name}}</option>
              @endforeach

              </select>

            @error('district_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
           
         </div>

        
          <div class="form-group col-md-12">
		    <textarea name="shipping_address" id="message" required="required" class="form-control @error('shipping_address') is-invalid @enderror" rows="8" placeholder="Your Shipping Address Here">{{ $user->shipping_address }}</textarea>
		  </div>   
         <div class="form-group col-md-12">
              <input id="password" placeholder="New Password optional" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

            @if ($errors->has('password'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
           
         </div>

     
                              
        <div class="form-group col-md-12">
            
            <button type="submit" class="btn btn-primary pull-left">
             Update Profile
           </button>
        </div>
    </form>


</div>
</div>
			
</div>  
</div>	
</div><!--/#contact-page-->


@endsection
