@extends('frontend.layouts.master')

@section('content')

 <section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
             
             
           @foreach($sliders as $slider)
              <div class="item  {{$loop->index == 0 ? 'active':''}}">
                <div class="col-sm-6">
                  <h1><span>E</span>-{{$slider->title_h1}}</h1>
                  <h2>{{$slider->title_h2}}</h2>
                  <p>{{$slider->title_p}}</p>
                  <button type="button" class="btn btn-default get">{{$slider->button_text}}</button>
                </div>
                <div class="col-sm-6">
                  <img src="{{ asset('images/sliders/'.$slider->image) }}" class="girl img-responsive" alt="{{$slider->title_h1}}" />
                
                </div>
              </div>
             @endforeach
           
              
             
              
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->
  
  <section>
    <div class="container">
      <div class="row">

 @include('frontend.partials.category')
 
        
        <div class="col-sm-9 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
           
      @foreach($products as $product)

            <div class="col-sm-4">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">

                     @php $i = 1; @endphp

                      @foreach($product->images as $image)
                     <!--  <img src="{{asset('frontend/images/home/product1.jpg')}}" alt="" /> -->
                       @if ($i > 0)
                        <img class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image) }}" alt="Card image" >
                        @endif
                        @php $i--; @endphp
                        @endforeach

                      <h2>{{ $product->price }} TK</h2>
                    <a href="{!! route('products.show', $product->id) !!}">  <p>{{ $product->title }}</p></a>
                      <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>{{ $product->price }} TK</h2>
                       <a href="{!! route('products.show', $product->id) !!}">  <p>{{ $product->title }}</p></a>
                     

                       @include('frontend.pages.cart-button')

                      </div>
                    </div>
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                  </ul>
                </div>
              </div>
            </div>

      @endforeach

    

            
          </div><!--features_items-->
          
         
         
      </div>
    </div>
  </section>
  
 @endsection