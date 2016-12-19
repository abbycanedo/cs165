@extends('layouts.index')

@section('title', 'Shop')

@section('panel-title', 'Products')

@section('panel-body')
<div class="content-row">
<!--
  <div class="row">
    <select name="select">
      <option value="1" style="background-color: #F12222">Red</option>
      <option value="2" style="background-color: #7b1113">Maroon</option>
    </select>
  </div>
 -->
  <div class="row">
    @foreach($products as $product)
      <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          <img class="img-rounded home" src="/uploads/{{$product->imageurl}}"/>
          <div class="caption text-center">
            <p><b>{{$product->brand}}</b></p>
            <p>{{str_limit($product->name, 25)}}</p>
            <p><b>Php {{round($product->price, 2)}}</b></p>
            <p>
              <a href="{{ route('product.details', $product->id ) }}" class="btn btn-default" role="button">
                <i class="glyphicon glyphicon-eye-open"></i> View Item
              </a>
            </p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection