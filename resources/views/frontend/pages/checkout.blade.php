@extends('frontend.layouts.master')
@section('content')
<section id="cart_items">
   <div class="container">
      <div class="breadcrumbs">
         <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Check out</li>
         </ol>
      </div>
      <!--/breadcrums-->
      <div class="review-payment">
         <h2>Review & Payment</h2>
      </div>
      <div class="table-responsive cart_info">
         <table class="table table-condensed">
            <thead>
               <tr class="cart_menu">
                  <td class="image">No</td>
                  <td class="image">Item</td>
                  <td class="description"></td>
                  <td class="price">Price</td>
                  <td class="quantity">Quantity</td>
                  <td class="total">Unite Price</td>
                  <td class="total">Sub Total Price</td>
                  <td class="total">Delete</td>
                  <td></td>
               </tr>
            </thead>
            <tbody>
               @php
               $total_price = 0;
               @endphp
               @foreach(App\Cart::totalCarts() as $cart)
               <tr>
                  <td class="cart_product">
                     <p>{{$loop->index+1}}</p>
                  </td>
                  <td class="cart_product">
                     @if($cart->product->images->count() > 0)
                  <td><img src="{{asset('images/products/'. $cart->product->images->first()->image)}}" style="height: 80px; width: 80px;"></td>
                  @endif
                  </td>
                  <td class="cart_description">
                     <h4>{{$cart->product->title}}</h4>
                  </td>
                  <td class="cart_price">
                     <p>{{$cart->product->price}}</p>
                  </td>
                  <td class="cart_quantity">
                     <div class="cart_quantity_button">
                        <form class="form-inline" action="{{route('carts.update',$cart->id)}}" method="post">
                           @csrf
                           <input class="cart_quantity_input" type="number" name="product_quantity" value="{{$cart->product_quantity}}" class="form-control">
                           <button type="submit" class="btn btn-success ml-1"><i class="fa fa-edit"></i></button>
                        </form>
                     </div>
                  </td>
                  <td class="cart_total">
                     <p class="cart_total_price">{{$cart->product->price}} Taka</p>
                  </td>
                  <td class="cart_total">
                     @php
                     $total_price += $cart->product->price * $cart->product_quantity;
                     @endphp
                     <p class="cart_total_price">{{$cart->product->price * $cart->product_quantity}} Taka</p>
                  </td>
                  <td class="cart_quantity">
                     <div class="cart_quantity_button">
                        <form class="form-inline" action="{{route('carts.delete',$cart->id)}}" method="post">
                           @csrf
                           <input class="cart_id" type="hidden" name="product_quantity" value="" class="form-control">
                           <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </form>
                     </div>
                  </td>
               </tr>
               @endforeach
               <tr>
                  <td colspan="6">&nbsp;</td>
                  <td colspan="2">
                     <table class="table table-condensed total-result">
                        <tr>
                           <td>Total</td>
                           <td><span>{{$total_price}} Taka</span></td>
                        </tr>
                        <tr class="shipping-cost">
                           <td>Shipping Cost</td>
                           <td>{{$total_price + App\Setting::first()->shipping_cost}} Taka</td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="shopper-informations">
         <div class="row">
            <div class="col-sm-8">
               <div class="shopper-info">
                  <div class=" step-one">
                     <h2 class="heading">Shopper Information</h2>
                  </div>

					     @if (Session::has('success'))
					  <div class="alert alert-success">
					    <p>{{ Session::get('success') }}</p>
					  </div>
					   @endif

					     @if ($errors->any())
					                <div class="alert alert-danger">
					                    <ul>
					                        @foreach ($errors->all() as $error)
					                            <li>{{ $error }}</li>
					                        @endforeach
					                    </ul>
					                </div>
					   @endif


                  <form method="POST" action="{{ route('checkout.store') }}">
                     @csrf
                     
                      <label for="name" class="col-md-4 col-form-label text-md-right">Reciever Name</label>
                  
                     <input id="name" placeholder="Reciever Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name : '' }}" required autofocus>
                   
                     @if ($errors->has('name'))
                     <span class="invalid-feedback">
                     <strong>{{ $errors->first('name') }}</strong>
                     </span>
                     @endif
                    
                      <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                    
                     <input id="email" type="email" placeholder="E-Mail Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                    
                     @if ($errors->has('email'))
                     <span class="invalid-feedback">
                     <strong>{{ $errors->first('email') }}</strong>
                     </span>
                     @endif
                    
                      <label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone No</label>
                   
                     <input id="phone_no" type="text" placeholder="phone No" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required>
                   
                     @if ($errors->has('phone_no'))
                     <span class="invalid-feedback">
                     <strong>{{ $errors->first('phone_no') }}</strong>
                     </span>
                     @endif
                     
                      <label for="message" class="col-md-4 col-form-label text-md-right">Additional Message (optional)</label>
                   
                     <textarea id="message" placeholder="Additional Message (optional)" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" rows="4" name="message"></textarea>
                     @if ($errors->has('message'))
                     <span class="invalid-feedback">
                     <strong>{{ $errors->first('message') }}</strong>
                     </span>
                     @endif
                     <br>
                    
                      <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address (*)</label>
                    
                     <textarea id="shipping_address" placeholder="Shipping Address (*)" class="form-control{{ $errors->has('shipping_address') ? ' is-invalid' : '' }}" rows="4" name="shipping_address">{{ Auth::check() ? Auth::user()->shipping_address : '' }}</textarea>

                     @if ($errors->has('shipping_address'))
                     <span class="invalid-feedback">
                     <strong>{{ $errors->first('shipping_address') }}</strong>
                     </span>
                     @endif

                      <label for="payment_method" class="col-md-4 col-form-label text-md-right">Select a payment method</label>

                      <select class="form-control" name="payment_method_id" required id="payments">

		              <option value="">Select a payment method please</option>

		              @foreach ($payments as $payment)

		                <option value="{{ $payment->short_name }}">{{ $payment->name }}</option>

		              @endforeach

		            </select>

		    @foreach ($payments as $payment)
              @if ($payment->short_name == "cash_in")
                <div id="payment_{{ $payment->short_name }}" class="alert alert-success mt-2 text-center hidden">
                  <h3>
                    For Cash in there is nothing necessary. Just click Finish Order.
                    <br>
                    <small>
                      You will get your product in two or three business days.
                    </small>
                  </h3>
                </div>
              @else
                <div id="payment_{{ $payment->short_name }}" class="alert alert-success mt-2 text-center hidden"
                  <h3>{{ $payment->name }} Payment</h3>
                  <p>
                    <strong>{{ $payment->name }} No :  {{ $payment->no }}</strong>
                    <br>
                    <strong>Account Type: {{ $payment->type }}</strong>
                  </p>
                  <div class="alert alert-success">
                    Please send the above money to this Bkash No and write your transaction code below there..
                  </div>

                </div>
              @endif
            @endforeach
              <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden " placeholder="Enter transaction code">

                    <!--   <a class="btn btn-primary" href="">Get Quotes</a>
                  <a class="btn btn-primary" href="">Continue</a> -->

                   <button type="submit" class="btn btn-primary">
              Order Now
            </button>

                  </form>
                 
               </div>
            </div>
         </div>
         <br>
         <br>
      </div>
   </div>
</section>
<!--/#cart_items-->
@endsection


@section('scripts')

<script type="text/javascript">
$("#payments").change(function(){
    $payment_method = $("#payments").val();
    if ($payment_method == "cash_in") {
      $("#payment_cash_in").removeClass('hidden');
      $("#payment_bkash").addClass('hidden');
      $("#payment_rocket").addClass('hidden');
    }else if ($payment_method == "bkash") {
      $("#payment_bkash").removeClass('hidden');
      $("#payment_cash_in").addClass('hidden');
      $("#payment_rocket").addClass('hidden');
      $("#transaction_id").removeClass('hidden');
    }else if ($payment_method == "rocket") {
      $("#payment_rocket").removeClass('hidden');
      $("#payment_bkash").addClass('hidden');
      $("#payment_cash_in").addClass('hidden');
      $("#transaction_id").removeClass('hidden');
    }
  })
	
</script>

@endsection