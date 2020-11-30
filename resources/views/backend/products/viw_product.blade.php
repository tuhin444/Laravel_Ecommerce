@extends('backend.layouts.master')
 @section('title','List Product')
@push('css')

<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

@endpush

@section('content')


<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="header-icon">
<i class="fa fa-product-hunt" aria-hidden="true"></i>
</div>
<div class="header-title">
<h1>Product</h1>
<small>Product List</small>
</div>
</section>

    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_success') }}</strong>
    </div>
    @endif

 <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
 <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-sm-12">
 <div class="panel panel-bd lobidrag">
    <div class="panel-heading">
       <div class="btn-group" id="buttonexport">
          <a href="{{url('admin/add-product')}}">
             <h4>Add Product</h4>
          </a>
       </div>
    </div>
    <div class="panel-body">
    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
       <div class="btn-group">
          <div class="buttonexport" id="buttonlist"> 
             <a class="btn btn-add" href="{{url('admin/add-product')}}"> <i class="fa fa-plus"></i> Add Product
             </a>  
          </div>
       
       </div>
       <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
       <div class="table-responsive">
          <table id="example" class="table table-bordered table-striped table-hover">
             <thead>
                <tr class="info">
                   <th>Photo</th>
                   <th>Name</th>
                   <th>Code</th>
                   <th>Coler</th>
                   <th>Description</th>
                   <th>Price</th>
 
                   <th>Status</th>
                   <th>Featured Products</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>
               @foreach($products as $product)
                <tr>
                  <td> <img src="{{ asset('uploads/products/' . $product->image) }}" / style="height: 48px;width: 65px;"> </td> 
                   <td>{{$product->name}}</td>
                   <td>{{$product->code}}</td>
                   <td>{{$product->color}}</td>
                   <td>{{$product->description}}</td>
                   <td>{{$product->price}}</td>
               

                  <td>
                       <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}"
                       data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                       @if($product['status']=="1") checked @endif>
                       <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                       </td>
                

                  <td>
                       <input type="checkbox" class="FeaturedStatus btn btn-success" rel="{{$product->id}}"
                       data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                       @if($product['status']=="1") checked @endif>
                       <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                  </td>
                   <td>

                 <a href="{{url('/admin/add-images/'.$product->id)}}" class="btn btn-warning btn-sm" title="Add Product"><i class="fa fa-picture-o" aria-hidden="true"></i></a>   
                 <a href="{{url('/admin/add-attributes/'.$product->id)}}" class="btn btn-info btn-sm" title="Edit Product"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-add btn-sm" title="Edit Product"><i class="fa fa-pencil"></i></a>
           <a href="{{url('/admin/delete-product/'.$product->id)}}" class="btn btn-danger btn-sm" title="Delete Product"><i class="fa fa-trash-o"></i> </a>
                   </td>
                </tr>
                @endforeach
             </tbody>
          </table>
       </div>
    </div>
 </div>
</div>
</div>
<!-- customer Modal1 -->

<!-- /.modal -->
<!-- Modal -->    
<!-- Customer Modal2 -->

<!-- /.modal -->
</section>
<!-- /.content -->
</div>


@endsection  
@push('js')

<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>




@endpush  