@extends('frontend.layouts.master')

@section('content')
  
  <section>
    <div class="container">
      <div class="row">


     @include('frontend.partials.category')

     
        
        <div class="col-sm-9 padding-right">
          <div class="product-details"><!--product-details-->
            <div class="col-sm-5"> 
              <div class="view-product">
                @foreach($products->images as $image)
              <!--   <img src="{{asset('frontend/images/product-details/1.jpg')}}" alt="" /> -->
                <img class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image) }}" alt="Card image" >
                @endforeach
                <h3>ZOOM</h3>
              </div>
              <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                  <!-- Wrapper for slides -->
                  
                  <!-- Controls -->
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                  </a>
              </div>

            </div>
            <div class="col-sm-7">
              <div class="product-information"><!--/product-information-->
                <img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                <h2>Anne Klein Sleeveless Colorblock Scuba</h2>
                <p>Web ID: 1089772</p>
                <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
                <span>
                  <span>{{$products->price}} TK</span>
                  <lavel>Quantity:</lavel>
                  <input type="text" value="{{$products->quantity < 1 ? 'No item Avalable' : $products->quantity.''}}" />
                 
                  <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                  </button>


                  
                </span>
                <p><b>Availability:</b> "{{$products->quantity < 1 ? 'No item Avalable' : $products->quantity.'In Stock'}}"</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> E-SHOPPER</p>
               
              </div><!--/product-information-->
            </div>
          </div><!--/product-details-->
          
        
      
          
        </div>
      </div>
    </div>
  </section>
  
 @endsection