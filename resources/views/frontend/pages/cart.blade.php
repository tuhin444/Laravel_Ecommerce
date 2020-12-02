@extends('frontend.layouts.master')

@section('content')

   @if (App\Cart::totalItems() > 0)
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
						
					</tbody>
				</table>

			</div>
		</div>
	</section> <!--/#cart_items-->
	

	<section id="do_action">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
							<li>Total <span>{{$total_price}} Taka</span></li>
						</ul>
							<a class="btn btn-default update" href="{{url('/')}}">Continue Shopping</a>
							<a class="btn btn-default check_out" href="{{route('checkout')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	 @else
		<section id="do_action">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
							
						</ul>
							<a class="btn btn-default update" href="{{url('/')}}">Continue Shopping</a>
						
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	  
  @endif
	

@endsection
