@extends('frontend.layouts.master')

@section('content')


    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li class="active">Reset Password</li>
                </ol>
            </div><!--/breadcrums-->

            


            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-7 mt-40" style="margin-left: 20%;">
                        <div class="shopper-info">
                            <p>Reset Your Password</p>

                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                            <form method="POST" action="{{ route('password.email') }}">
                             @csrf

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                 <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>


                            </form>
                           
                        </div>
                        <br>
                           <br>
                           <br>
                           <br>
                           <br>
                    </div>
                     
                                
                </div>
            </div>
            
                <br>
                    <br>
        
        </div>
    </section> <!--/#cart_items-->

    
        
      
@endsection
