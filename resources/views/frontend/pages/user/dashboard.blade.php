@extends('frontend.layouts.master')

@section('content')


   
   <div id="contact-page" class="container">
      <div class="bg">
        <div class="row">       
          <div class="col-sm-12">                 
         <h2>Welcome {{ $user->first_name . ' '. $user->last_name }}</h2>
    <p>You can change your profile and every informations here..</p> 
    <div class="card card-body mt-2 pointer" onclick="location.href='{{ route('user.profile') }}'">
          <h3>Update Profile</h3>
        </div>                               
          <div id="gmap" class="contact-map">
          </div>
        </div>          
      </div>      
        <div class="row">   
          <div class="col-sm-8">
            <div class="contact-form">
            
              <div class="status alert alert-success" style="display: none"></div>
             
            </div>
          </div>
         
          </div>          
        </div>  
      </div>  
    </div><!--/#contact-page-->
  

@endsection
