@extends('frontend.layouts.master')

@section('content')


    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li class="active">Login</li>
                </ol>
            </div><!--/breadcrums-->

            
                    <br>
                    <br>

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-7" style="margin-left: 20%;">
                        <div class="shopper-info">
                            <p>Login Information</p>
                            <form method="POST" action="{{ route('login') }}">
                             @csrf



                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror





                           <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                         </div>
                            </form>
                           
                        </div>
                    </div>
                    
                                
                </div>
            </div>
            
                <br>
                    <br>

                      <br>
                    <br>
        
        </div>
    </section> <!--/#cart_items-->

    

       
@endsection
