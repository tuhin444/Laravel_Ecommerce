@extends('frontend.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">
        @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_success') }}</strong>
    </div>
    @endif
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
             <div class="contact-form-right">
                 <h2>Change Password</h2>
                 <form action="{{url('/change-address')}}" method="POST" id="contactForm registerForm"> 
                   @csrf
                     <div class="row">
                         
                         <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->name}}" id="name" name="name" required data-error="Please Enter Your Email" placeholder="Your Name">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->address}}" id="address" name="address" required data-error="Please Enter Your Email" placeholder="Your address">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->city}}" id="city" name="city" required data-error="Please Enter Your Email" placeholder="Your City">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->state}}" id="state" name="state" required data-error="Please Enter Your Email" placeholder="state">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <select name="country" id="country" class="form-control">
                                   <option value="1">Select Country</option>
                                   @foreach($countries as $country)
                                   <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                   @endforeach
                               </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->pincode}}" id="pincode" name="pincode" required data-error="Please Enter Your Email" placeholder="pincode">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$userDetails->mobile}}" id="mobile" name="mobile" required data-error="Please Enter Your Password" placeholder="mobile">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                     </div>
                 </form>
             </div>

         </div>
         <div class="col-md-3"></div>
     </div>
    </div>

</div>

@endsection