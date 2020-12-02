@extends('frontend.layouts.master')

@section('content')


  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}">Home</a></li>
          <li class="active">Sign Up</li>
        </ol>
      </div><!--/breadcrums-->

      


      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-7" style="margin-left: 19%;">
            <div class="shopper-info">
              <p>Signup Information</p>
             <form method="POST" action="{{ route('register') }}">
               @csrf
              
                 <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>

                  @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif

                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 


                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 



                <input id="email" type="email" placeholder="Email Adress" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                  <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" placeholder="Phone No" value="{{ old('phone_no') }}" required autocomplete="phone_no" autofocus>

                @error('phone_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror   



             <select class="form-control"  name="divistion_id" id="divistion_id">
              <option value="">Please Select Divistion </option>
              @foreach($divistions as $divistion)
                 <option value="{{$divistion->id}}">{{$divistion->name}}</option>
              @endforeach

              </select>

                @error('divistion_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

             <br>


              <select class="form-control" name="district_id" id="district_id">
              <option value="">Please Select District </option>
              @foreach($districts as $district)
                 <option value="{{$district->id}}">{{$district->name}}</option>
              @endforeach

              </select>

                @error('district_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


               <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" placeholder="Street Adress" name="street_address" value="{{ old('street_address') }}" required autocomplete="street_address" autofocus>

                @error('street_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                  <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">   



               

              <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
              </form>
            
            </div>
          </div>
          
                
        </div>
      </div>
      
                <br>
          <br>
    
    </div>
  </section> <!--/#cart_items-->

  
  
@endsection

@section('scripts')
 <!--  <script>

    $("#divistion_id").change(function(){
        var divistion = $("#divistion_id").val();
       //send an ajex request to server with this divistion
       $.post( "ajax/test.html", function( data ) {
       $( ".result" ).html( data );
       });
    })
  
  </script> -->
@endsection

