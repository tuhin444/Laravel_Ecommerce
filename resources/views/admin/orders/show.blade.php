@extends("admin.layouts.master")
@section('content')

  
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         
          
          <div class="row">


            <div class="col-lg-12 col-md-12">

               <div class="btn btn-warning">
                  <a style="color: #ffffff !important;" href="{{route('admin.order')}}">Back</a>
                </div>
             
                 <div class="btn btn-danger">
                    View order #lE {{ $order->id}}
                   
                </div>
               

              <div class="card">
                   
               
                <div class="card-body">

						   @if (Session::has('success'))
						  <div class="alert alert-success">
						    <p>{{ Session::get('success') }}</p>
						  </div>
						   @endif

						    @if ($errors->any())
			                <div class="alert alert-danger">
			                    <ul>
			                        @foreach ($errors->all() as $error)
			                            <li>{{ $error }}</li>
			                        @endforeach
			                    </ul>
			                </div>
			                 @endif

                  <div class="tab-content">
                   
                    <div class="tab-pane active" id="profile">
                    	<h3>Order Information</h3>
                     
                        <div class="row">
                      	<div class="col-md-6 border-right" >
                      		<p><strong>Order Name:</strong>{{$order->name}}</p>
                      		<p><strong>Order Phone:</strong>{{$order->phone_no}}</p>
                      		<p><strong>Order email:</strong>{{$order->email}}</p>
                      		<p><strong>Order Shopping Address:</strong>{{$order->shipping_address}}</p>
                      	</div>
                      		<div class="col-md-6">
                      		<p><strong>Order Payment Method:</strong>{{$order->payment->name}}</p>
                      		<p><strong>Order Payment Transaction:</strong>{{$order->payment->transaction_id}}</p>

                    
                      	</div>
                      	<hr>

                      	<form action="{{route('admin.order.completed',$order->id)}}" method="POST">
                      		@csrf
                      		@if($order->is_completed)

                              <input type="submit" value="Cancel order" name="" class="btn btn-danger">
                           	
                           	@else
                           	   <input type="submit" value="Completed order" name="" class="btn btn-success">
                            @endif
                      		
                      	</form>

                      	<form action="{{route('admin.order.paid',$order->id)}}" method="POST">
                      		@csrf
                      		@if($order->is_paid)
                      		<input type="submit" value="Cancel Payment" name="" class="btn btn-danger">
                      		@else
                      		<input type="submit" value="Paid Payment" name="" class="btn btn-success">
                      		@endif
                      		
                      	</form>
                      

                      <div>
                    </div>
                    </div>
                   
                   
                  </div>
                 
  

 @endsection