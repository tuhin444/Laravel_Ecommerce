 
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
                  <a style="color: #ffffff !important;" href="{{route('admin.slider.create')}}">Add Slider</a>
                </div>
                <div class="btn btn-warning">
                  <a style="color: #ffffff !important;" href="{{route('admin.slider.showlist')}}">View List</a>
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
                  <h4 class="card-title" style="text-align:center;">Update Slider</h4>
                
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




                         
      
                         
            <form action="{{route('admin.slider.update',$sliders->id)}}" method="post" enctype="multipart/form-data">
      
                @csrf

          <div class="form-group">
            <label for="exampleInputEmail1">Title H1</label>
            <input type="text" class="form-control" value="{{$sliders->title_h1}}" name="title_h1" >
          </div>
           <div class="form-group">
            <label for="exampleInputEmail1">Title H2</label>
            <input type="text" class="form-control" name="title_h2" value="{{$sliders->title_h2}}">
          </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Title P</label>
            <input type="text" class="form-control" name="title_p" value="{{$sliders->title_p}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Button Text</label>
            <input type="text" class="form-control" name="button_text" value="{{$sliders->button_text}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Button Link</label>
            <input type="text" class="form-control" name="button_link" value="{{$sliders->button_link}}">
          </div>
          <div class="col-md-4">
              <label for="image">Slider Image</label>
              <a href="{{ asset('images/sliders/'.$sliders->image) }}" target="_blank">Previous Image</a>
              <input type="file" class="form-control" name="image" id="image" placeholder="Slider Image" >
            </div>

          



       <br>
        <button type="submit" class="btn btn-primary">Edit Slider</button>   
         
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