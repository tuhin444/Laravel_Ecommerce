 
@extends('admin.layouts.master')

@section('content')


      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
         
          <div class="row">
            <div class="col-md-2">
            </div>
           
            <div class="col-lg-12 col-md-12">

                 <div class="btn btn-warning">
                  <a style="color: #ffffff !important;" href="{{route('admin.index')}}">Back</a>
                </div>

               <div class="btn btn-danger">
                  <a style="color: #ffffff !important;" href="{{route('admin.product.showlist')}}"> View</a>
                </div>
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title" style="text-align:center;">Add Product</h4>
                
                </div>
                <div class="card-body table-responsive">
              

              @if ($errors->any())
                <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif




                         
            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
      
                @csrf



               <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title">
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
          
            <textarea class="form-control" name="description" rows="3"></textarea>
          </div>


           <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="text" class="form-control" name="quantity">
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" name="price">
           </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control" name="slug">
          </div>



             <div class="form-group">
              <label for="exampleInputEmail1">Select Category</label>
              <select class="form-control" name="category_id">
                <option value="">Please select a category for the product</option>
                @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
                  <option value="{{ $parent->id }}">{{ $parent->name }}</option>

                  @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                    <option value="{{ $child->id }}"> ------> {{ $child->name }}</option>

                  @endforeach

                @endforeach
              </select>
            </div>




              <div class="form-group">
              <label for="exampleInputEmail1">Select Brand</label>
              <select class="form-control" name="brand_id">
                <option value="">Please select a brand for the product</option>
                @foreach (App\Brand::orderBy('name', 'asc')->get() as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
            </div>


          

          <div class="frrm-group">
            <label for="product_image">Product Image</label>

            <div class="row">
            <div class="col-md-4">
            <input type="file" class="form-control" name="product_image[]" id="product_image" >
           </div>

           <div class="col-md-4">
            <input type="file" class="form-control" name="product_image[]" id="product_image" >
           </div>


           <div class="col-md-4">
            <input type="file" class="form-control" name="product_image[]" id="product_image" >
           </div>

          
           <div class="col-md-4">
            <input type="file" class="form-control" name="product_image[]" id="product_image">
           </div>

            <div class="col-md-4">
            <input type="file" class="form-control" name="product_image[]" id="product_image">
           </div>
        </div>
        </div>


<br>


                 
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>






                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </div>

 
      
@endsection