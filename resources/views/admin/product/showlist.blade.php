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
                  <a style="color: #ffffff !important;" href="{{route('admin.product.create')}}">Add Product</a>
                </div>
              <div class="card">
               
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table" id="dataTable">
                        <thead>
                           <th>ID</th>
                           <th>Title</th>
                           <th>Quantity</th>
                           <th>Price</th>
                           <th>Description</th>
                           <th>Action</th>
                        </thead>
                        <tbody>
                          
                          
                          @foreach ($products as $product)

                         <tr>
                         
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                             <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                          

                           
                           
                            
                        <td class="td-actions text-right">
                          <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-success">Edit</a>
                          <a href="#deleteModal{{ $product->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                           <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are sure to delete?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                            <form action="{{route('admin.product.delete', $product->id) }}"  method="post">
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
                           <th>Title</th>
                           <th>Quantity</th>
                           <th>Price</th>
                           <th>Description</th>
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