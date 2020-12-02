 
@extends('admin.layouts.master')

@section('content')


      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
         
          <div class="row">
            <div class="col-md-2">
            </div>
           
            <div class="col-lg-8 col-md-12">
              <div class="card">
  



                  @if (Session::has('success'))
                  <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                  </div>
                   @endif
                   <br>
                   <br>


   
                <div class="card-header card-header-warning">
                  <h4 class="card-title" style="text-align:center;">Update Category</h4>
                
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




                         
       <form action="{{route('admin.category.update',$categorys->id)}}" method="post" enctype="multipart/form-data">
      
                @csrf



          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" value="{{$categorys->name}}">
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
          
            <textarea class="form-control" name="description" rows="3">{{$categorys->description}}</textarea>
          </div>


     <div class="form-group">
      <label for="exampleInputEmail1">Parent Category</label>
     <select class="form-control" name="parent_id" id="sel1">
     
      @foreach ($manage_category as $cat)
      <option value="{{$cat->id}}" {{ $cat->id == $cat->parent_id ? 'selected' : '' }}>{{$cat->name}}</option>
      @endforeach

    </select>
     </div>





          <div class="frrm-group">
            <label for="Category Image">Category Image</label>
            <p>New Image</p>
            <div class="row">
            <div class="col-md-4">
            <input type="file" class="form-control" name="image" >
           </div>
         </div>
          <div class="row">
            <div class="col-md-4">
           Old Image:<img src="{{URL::to($categorys->image)}}" style="width: 100px; height: 100px;">
             <input type="hidden" class="form-control"  required name="old_photo" value="{{$categorys->image}}">
           </div>
         </div>
        </div>

         

<br>


                 
          <button type="submit" class="btn btn-primary">Update Category</button>
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