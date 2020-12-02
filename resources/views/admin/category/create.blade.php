 
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
                  <a style="color: #ffffff !important;" href="{{route('admin.category.showlist')}}">View</a>
                </div>
              <div class="card">
  



                  @if (Session::has('success'))
                  <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                  </div>
                   @endif
                   <br>
                   <br>


   
                <div class="card-header card-header-warning">
                  <h4 class="card-title" style="text-align:center;">Add Category</h4>
                
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




                         
            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
      
                @csrf



          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name">
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
          
            <textarea class="form-control" name="description" rows="3"></textarea>
          </div>


           <div class="form-group">
            <label for="exampleInputEmail1">Parent Category</label>
           <select class="form-control" name="parent_id" id="sel1">
            <option value="">Please select a Parent category</option>
            @foreach ($manage_category as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach

          </select>
           </div>

         


       

          <div class="frrm-group">
            <label for="image">Category Image</label>

            <div class="row">
            <div class="col-md-4">
            <input type="file" class="form-control" name="image" id="image" >
           </div>

           
        </div>
        </div>


<br>


                 
          <button type="submit" class="btn btn-primary">Add Categoty</button>
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