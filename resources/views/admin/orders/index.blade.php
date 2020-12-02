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
                  <a style="color: #ffffff !important;" href="">Orders Show</a>
                </div>
               

              <div class="card">
                   
               
                <div class="card-body">

                  <div class="tab-content">
                   
                    <div class="tab-pane active" id="profile">
                      <table class="table" id ="dataTable">
                        <thead>
                          <tr>
                           <th>#</th>
                           <th>ID</th>
                           <th>Order Name</th>
                           <th>Order phone No</th>
                           <th>Order Paid</th>
                           <th>Order Complete</th>
                           <th>Order Seen </th>
                           <th>Action</th>
                         </tr>
                       </thead>
                         
                    <br>
                  <tbody>
                     
                    
                    @foreach ($orders as $order)

                   <tr>
                   
                      <td>{{ $loop->index + 1}}</td>
                      <td>#LC{{ $order->id }}</td>
                      <td>{{ $order->name }}</td>
                      <td>{{ $order->phone_no }}</td>
                    
                     

                      <td>
                        <p>
                       @if ($order->is_paid)
                        <button type="button" class="btn btn-success">Paid</button>
                        @else
                        <button type="button" class="btn btn-danger">Unpaid</button>
                        
                        @endif
                        </p>
                      </td>
                        <td>
                          <p>
                         @if ($order->is_completed)
                          <button type="button" class="btn btn-success">Complete</button>
                          @else
                          <button type="button" class="btn btn-danger">In Complete</button>
                          
                          @endif
                          </p>
                      </td>

                      <td>
                        <p>
                       @if ($order->is_seen_by_admin)
                        <button type="button" class="btn btn-success">Seen</button>
                        @else
                         <button type="button" class="btn btn-danger">Unseen</button>
                        
                        @endif
                        </p>
                      </td>



         
                      
                    
            <td class="td-actions text-right">
                
                 <a href="{{ route('admin.order.show',$order->id)}}" class="btn btn-primary">Order View</a>
                 <a href="#deleteModal{{ $order->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                   <!-- Delete Modal -->
                 <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                    <form action="{{route('admin.order.delete', $order->id) }}"  method="post">
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
                        <tr>
                           <th>#</th>
                           <th>ID</th>
                           <th>Order Name</th>
                           <th>Order phone No</th>
                           <th>Order Paid</th>
                           <th>Order Complete</th>
                           <th>Order Seen </th>
                           <th>Action</th>
                        </tr>
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