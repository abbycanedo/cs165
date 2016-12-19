@extends('layouts.index')

@section('title', 'Products')

@section('panel-title', 'Products')

@section('panel-body')
<div class="content-row">
  <a href="{{ url('/products/add') }}" class="btn btn-success f-right">
    <i class="fa fa-btn fa-plus"></i> Add Product
  </a>
</div>
<div class="content-row">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th align="center">Code</th>
          <th align="center">Brand</th>
          <th align="center">Name</th>
          <th align="center">Status</th>
          <th align="center">Quantity</th>
          <th align="center">Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{$product->code}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->name}}</td>
            @if ($product->status == 0)
              <td>Out of Stock</td>
            @else
              <td>Available</td>
            @endif
            <td align="right">{{$product->quantity}}</td>
            <td align="right">{{$product->price}}</td>
            <td class="col-md-2" align="center">
              <!-- view edit delete -->
              <!-- <a class="tbl_del" href="#">delete</a> -->
              <form class="form-horizontal" role="form" method="POST" action="{{ route('product.delete', $product->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a class="btn btn-primary" href="{{ route('product.details', $product->id ) }}" title="View Product">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-warning" href="{{ route('product.edit', $product->id ) }}" title="Edit Product">
                    <i class="fa fa-edit"></i>
                </a>
                <input type="hidden" name="name" value="value" /> 
                <button type="submit" class="btn btn-danger" title="Delete Product">
                  <i class="fa fa-trash"></i>
                </btn>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection 