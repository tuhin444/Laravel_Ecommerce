@extends("admin.layouts.master")
@section('content')

  
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
          
          <div class="row">


            <div class="col-lg-12 col-md-12">

               <div class="btn btn-warning">
                  <a style="color: #ffffff !important;" href="{{route('admin.index')}}">Back</a>
                </div>
              <div class="btn btn-danger">
                  <a style="color: #ffffff !important;" href="{{route('admin.slider.create')}}">Add Slider</a>
                </div>
               

              <div class="card">
                   
               
                <div class="card-body">

                  <div class="tab-content">
                   
                    <div class="tab-pane active" id="profile">
                      <table class="table" id="dataTable">

                         
                    <br>
                  <tbody>
                    <thead>
                       <th>ID</th>
                       <th>Title H1</th>
                       <th>Title H2</th>
                       <th>Title P</th>
                       <th>Slider Image</th>
                     
                       <th>Action</th>
                    </thead>
                     
                    
                    
                    @foreach ($sliders as $slider)

                   <tr>
                   
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{$slider->title_h1}}</td>
                      <td>{{$slider->title_h2}}</td>
                      <td>{{$slider->title_p}}</td>
                      <td>
                  <img src="{!! asset('images/sliders/'.$slider->image) !!}" width="100">
                </td>

                    


                     
                      
                    
            <td class="td-actions text-right">
                <a href="{{route('admin.slider.edit',$slider->id)}}" class="btn btn-success">Edit</a>
                 <a href="#deleteModal{{ $slider->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                           <!-- Delete Modal -->
                         <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are sure to delete?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                            <form action="{{route('admin.slider.delete', $slider->id) }}"  method="post">
                                 @csrf
                                  <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                </form>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
               
              
            </td>
                  </tr>

                 @endforeach
                         
                        </tbody>
                        <tfoot>
                          <th>ID</th>
                           <th>Name</th>
                           <th>priority</th>
                           <th>Action</th>
                        </tfoot>
                      </table>
                    </div>
                   
                   
                  </div>
                </div>
              </div>
            </div>
      
          </div>
        </div>
      </div>
     
     
    </div>
  </div>

 @endsection