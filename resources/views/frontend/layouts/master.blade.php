
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>

@include('frontend.partials.styles')
@yield('styles')

</head><!--/head-->

<body>
  <header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="{{url('/')}}"><img src="{{asset('frontend/images/home/logo.png')}}" alt="" /></a>
            </div>
         
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
               
             
                <li><a href="{{route('checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                <li>
                  <a href="{{route('carts.index')}}"><i class="fa fa-shopping-cart"></i> Cart
                
   <span class="badge badge-danger" style="background-color: #d80e0e;">{{ App\Cart::totalItems() }}</span>


                  </a>
                </li>
              
              @guest
               <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
               
             @if (Route::has('register'))
              <li><a href="{{route('register')}}"><i class="fa fa-lock"></i> Register</a></li>
             @endif

              @else
                <li><a href="{{route('user.dashboard')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashbord</a></li>
                <li><a href="{{route('user.profile')}}"><i class="fa fa-user-md" aria-hidden="true"></i>Update profile</a></li>

                   <li class="nav-item dropdown">
                             

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                 <li>   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                     <i class="fa fa-sign-out" aria-hidden="true"></i>  {{ __('Logout') }}
                                    </a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest


              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->
  
  <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="{{url('/')}}" class="active">Home</a></li>
                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                    <li><a href="shop.html">Products</a></li>
                    <li><a href="{{url('single-page')}}">Product Details</a></li> 
                    <li><a href="{{route('checkout')}}">Checkout</a></li> 
                    <li><a href="{{route('carts.index')}}">Cart</a></li> 

                  

                                    </ul>
                                </li> 
                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                    <li><a href="blog.html">Blog List</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
                <li><a href="404.html">404</a></li>
                <li><a href="{{url('contact')}}">Contact</a></li>
              </ul>
            </div>
          </div>


          <div class="col-sm-3">
            <form action="{{route('products.search')}}" method="get">
               <div class="search_box pull-right">
              <input type="text" name="search" value="" placeholder="Search"/>
            </div>
            </form>
           
          </div>


        </div>
      </div>
    </div><!--/header-bottom-->


  </header><!--/header-->
  
 



    @yield('content')


   
 <footer id="footer"><!--Footer-->
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="companyinfo">
              <h2><span>e</span>-shopper</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
            </div>
          </div>
         
         
        </div>
      </div>
    </div>
        <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Service</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Online Help</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Order Status</a></li>
                <li><a href="#">Change Location</a></li>
                <li><a href="#">FAQ’s</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Quock Shop</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">T-Shirt</a></li>
                <li><a href="#">Mens</a></li>
                <li><a href="#">Womens</a></li>
                <li><a href="#">Gift Cards</a></li>
                <li><a href="#">Shoes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Policies</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privecy Policy</a></li>
                <li><a href="#">Refund Policy</a></li>
                <li><a href="#">Billing System</a></li>
                <li><a href="#">Ticket System</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Company Information</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Store Location</a></li>
                <li><a href="#">Affillate Program</a></li>
                <li><a href="#">Copyright</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3 col-sm-offset-1">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <form action="#" class="searchform">
                <input type="text" placeholder="Your email address" />
                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                <p>Get the most recent updates from <br />our site and be updated your self...</p>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
   
    
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
          <p class="pull-right">Designed by <span><a target="_blank" href="">Themeum</a></span></p>
        </div>
      </div>
    </div>
    
  </footer><!--/Footer-->
  
@include('frontend.partials.scripts');

@yield('scripts')

</body>
</html>