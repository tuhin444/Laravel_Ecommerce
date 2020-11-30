@extends('frontend.layouts.master')
@section('content')



    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
    
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
  <!-- End All Title Box -->
    @if(Session::has('flash_message_error'))
    <div class="alert alert-sm alert-danger alert-block" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
       <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif
    
    @if(Session::has('flash_message_success'))
    <div class="alert alert-sm alert-success alert-block" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
       <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif
    <!-- Start Shop Detail  -->
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                                 <?php $total_amount = 0; ?>
                            	 @foreach($userCarts as $cart)
                            <tbody>

                            
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
										<img class="img-fluid" src="{{asset('/uploads/products/'.$cart->image)}}" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									{{$cart->product_name}}
									<p>{{$cart->product_code}} | {{$cart->size}}</p>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ {{$cart->price}}</p>
                                    </td>
                                    <td class="quantity-box">
                                      <a href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}"  style="font-size:25px;">+</a>
                                    <input type="number" size="4" value="{{$cart->quantity}}" min="0" step="1" class="c-input-text qty text">
                                     @if($cart->quantity>1)
                                         <a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}"  style="font-size:25px;">-</a>
                                      @endif   
                                    </td>
                                    <td class="total-pr">
                                        <p> $ {{$cart->price*$cart->quantity}}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="{{url('/cart/delete-product/'.$cart->id)}}">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                                 @endforeach
                            </tbody>
                         
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                    	<form action="{{url('/cart/apply-coupon')}}" method="POST">
                    	@csrf	
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text" name="coupon_code">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
              
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        @if(!empty(Session::get('CouponAmount')))
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                              <div class="ml-auto font-weight-bold"> $ <?php echo $total_amount; ?> </div>
                        </div>
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                 <div class="ml-auto font-weight-bold"> $ <?php echo Session::get('CouponAmount'); ?> </div>
                        </div>
                        <hr class="my-1">
                          <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                             <div class="ml-auto h5"> $ <?php echo $total_amount - Session::get('CouponAmount'); ?> </div>
                        </div>

                         <hr>
                         @else
                           <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                             <div class="ml-auto h5"> $  <?php echo $total_amount - Session::get('CouponAmount'); ?> </div>
                        </div>

                         <hr>
                         @endif
                      
                      </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{url('/checkout')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
   
    <!-- End Instagram Feed  -->



@endsection