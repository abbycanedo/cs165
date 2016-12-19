@extends('layouts.index')

@section('title')
  @foreach($products as $product)
    {{$product->code}}
  @endforeach
@endsection

@section('panel-title')
  @foreach($products as $product)
    {{$product->brand}} - {{$product->name}}
  @endforeach
@endsection

@section('panel-body')
<div class="content-row">
  <div class="row">
    @foreach($products as $product)
      <div class="col-sm-6 col-md-6">
        <div class="thumbnail">
          <img class="img-rounded" src="/uploads/{{$product->imageurl}}"/>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 text-center cart">
        <div class="row">
          <h3>{{$product->brand}}</h3>
          <h4>{{$product->name}}</h4>
          <h5>Php {{$product->price}}</h5>
        </div>
        <div class="row">
          <div class="caption description">
            <p>{{$product->description}}</p>
            <h6>
              <b>Product Code: </b>
              {{$product->code}}
            </h6>
            @if($product->status==0)
              <b>NOT AVAILABLE</b>
              <p> No item left in stock. </p>
            @else
              <h6><b>AVAILABLE</b></h6>
              <p> {{$product->quantity}} item/s left in stock. </p>
            @endif
          </div>
        </div>
        @if(Auth::guest())
            <a href="{{ url('/login') }}" class="btn btn-default">
                <i class="fa fa-sign-in"></i> Log In to Buy Product
            </a>
        @else
          @if(Auth::user()->isadmin == 1)
            <a href="{{ route('product.edit', $product->id ) }}" class="btn btn-default">
                <i class="fa fa-edit"></i> Edit Item
            </a>
          @else
            @if($product->status==0)
              <button type="submit" class="btn btn-default" disabled>
                  <i class="fa fa-shopping-cart"></i> Add to Cart
              </button>
            @else
              <form class="form-horizontal" role="form" method="POST" action="{{ route('product.cart', $product->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="value" /> 
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>
              </form>
            @endif
          @endif
        @endif
      </div>
    @endforeach
  </div>
</div>

@endsection