@extends('layouts.index')

@section('title', 'Products')

@section('panel-title', 'Add Product')

@section('panel-body')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction.insert', Auth::user()->getKey()) }}">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label"></label>
          <div class="col-md-6">
            <h5 class="content-row-title">New Transaction</h5>
          </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="profile_id" class="col-md-4 control-label">Customer Email Address</label>

          <div class="col-md-6">
            <select required id="profile_id" type="text" class="form-control" name="profile_id">
              <option value="None" selected disabled>Select Customer Email</option>
              @foreach($profiles as $profile)
                <option value="{{$profile->id}}">{{$profile->email}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="product_id" class="col-md-4 control-label">Product Code</label>

          <div class="col-md-6">
            <select required id="product_id" type="text" class="form-control" name="product_id">
              <option value="None" selected disabled>Select Product Code</option>
              @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->code}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-success">
                  <i class="fa fa-btn fa-plus"></i> Add Transaction
              </button>
          </div>
      </div>
  </form>
</div>

@endsection 