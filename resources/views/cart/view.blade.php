@extends('layouts.index')

@section('title', 'Products')

@section('panel-title', 'Products')

@section('panel-body')
<div class="content-row">
  <form class="form-horizontal" role="form" method="POST" action="{{ route('cart.submit', Auth::user()->getKey()) }}">
    {{ csrf_field() }}
    <input type="hidden" name="total" value="value" /> 
    <button type="submit" class="btn btn-success f-right" title="Submit Cart">
      <i class="fa fa-check"></i> Checkout
    </button>
  </form>
  <a href="{{ route('home') }}" class="btn btn-default f-right">
    <i class="fa fa-btn fa-plus"></i> Add More Products
  </a>
</div>
<div class="content-row">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th align="center">Thumbnail</th>
          <th align="center">Product Code</th>
          <th align="center">Brand</th>
          <th align="center">Product Name</th>
          <th align="center">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td align="center">
              <img src="/uploads/{{$product->imageurl}}" width="50px"/>
            </td>
            <td align="left">{{$product->code}}</td>
            <td align="left">{{$product->brand}}</td>
            <td align="left">{{$product->name}}</td>
            <td align="right">{{$product->price}}</td>
            <td align="center">
              <form class="form-horizontal" role="form" method="POST" action="{{ route('cart.delete', $product->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="value" /> 
                <button type="submit" class="btn btn-danger" title="Remove from Cart">
                  <i class="fa fa-times-circle"></i>
                </btn>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td align="right" colspan="4">
            <b>Total</b>
          </td>
          <td align="right">
            @foreach($total as $t)
              {{$t->total}}
            @endforeach
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection 