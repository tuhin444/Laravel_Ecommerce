@extends('frontend.layouts.master')

@section('content')

  
  <section>
    <div class="container">
      <div class="row">

 @include('frontend.partials.category')
 
        
        <div class="col-sm-9 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>

             <h3> All Products in <span class="badge badge-info">{{ $category->name }} Category</span></h3>
          @php
          $products = $category->products()->paginate(9);
          @endphp

          @if($products->count() > 0)

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

                       



                      </div>
                    </div>
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>{{$category->name}} Category</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                  </ul>
                </div>
              </div>
            </div>

         @endforeach

   
          @else
          <div class="alert alert-warning">
              No Products has added yet in this category !!
            </div>
          @endif

           
     
    

            
          </div><!--features_items-->
          
        
          
         
          
        </div>
      </div>
    </div>
  </section>
  
 @endsection