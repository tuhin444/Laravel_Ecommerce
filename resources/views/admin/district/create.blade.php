 
@extends('admin.layouts.master')

@section('content')


      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
         
          <div class="row">
            <div class="col-md-2">
            </div>
           
            <div class="col-lg-12 col-md-12">

               <div class="btn btn-danger">
                  <a style="color: #ffffff !important;" href="{{route('admin.district.create')}}">Add District</a>
                </div>
                <div class="btn btn-warning">
                  <a style="color: #ffffff !important;" href="{{route('admin.district.showlist')}}">View List</a>
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
                  <h4 class="card-title" style="text-align:center;">Add District</h4>
                
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

    
            <form action="{{ route('admin.district.store') }}" method="post" >
                @csrf

            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Divistion ID</label>
              <select class="form-control" name="divistion_id">
              <option value="">Please Select Divistion </option>
              @foreach($divistions as $divistion)
                 <option value="{{$divistion->id}}">{{$divistion->name}}</option>
              @endforeach

              </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add District</button>   
         
      
        
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