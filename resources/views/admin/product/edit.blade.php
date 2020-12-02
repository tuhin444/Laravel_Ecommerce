 
@extends('admin.layouts.master')

@section('content')


      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
         
          <div class="row">
           
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Add Product</h4>
                
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




                         
            <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
      
                @csrf



               <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" value="{{ $product->title }}" name="title">
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
          
            <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
          </div>


           <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="text" class="form-control"  name="quantity" value="{{ $product->quantity }}">
          </div>


             <div class="form-group">
              <label for="exampleInputEmail1">Select Category</label>
              <select class="form-control" name="category_id">
                <option value="">Please select a category for the product</option>
                @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
                  <option value="{{ $parent->id }}" {{$parent->id == $product->category->id ? 'selected' : ''}}>{{ $parent->name }}</option>

                  @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                    <option value="{{ $child->id }}"{{$child->id == $product->category->id ? 'selected' : ''}}> ------> {{ $child->name }}</option>

                  @endforeach

                @endforeach
              </select>
            </div>



            
              <div class="form-group">
              <label for="exampleInputEmail1">Select Brand</label>
              <select class="form-control" name="brand_id">
                <option value="">Please select a brand for the product</option>
                @foreach (App\Brand::orderBy('name', 'asc')->get() as $br)
                  <option value="{{ $br->id }}"{{$br->id == $product->brand->id ? 'selected' : ''}}>{{ $br->name }}</option>
                @endforeach
              </select>
            </div>


           <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
           </div>

         
                 
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