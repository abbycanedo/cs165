@extends('layouts.index')

@section('title', 'Products')

@section('panel-title', 'Add Product')

@section('panel-body')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ route('product.add') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label"></label>
          <div class="col-md-6">
            <h5 class="content-row-title">Add Product</h5>
          </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Product Name</label>

          <div class="col-md-6">
              <input required id="name" type="text" class="form-control" name="name">

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Product Brand</label>

          <div class="col-md-6">
              <input required id="brand" type="text" class="form-control" name="brand">

              @if ($errors->has('brand'))
                  <span class="help-block">
                      <strong>{{ $errors->first('brand') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Quantity</label>

          <div class="col-md-6">
              <input required id="quantity" type="number" class="form-control" name="quantity" min="0">

              @if ($errors->has('quantity'))
                  <span class="help-block">
                      <strong>{{ $errors->first('quantity') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Price</label>

          <div class="col-md-6">
              <input required id="price" type="number" step="any" min="0" class="form-control" name="price">

              @if ($errors->has('price'))
                  <span class="help-block">
                      <strong>{{ $errors->first('price') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Description</label>

          <div class="col-md-6">
              <textarea id="price" class="form-control" name="description"></textarea>

              @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('imageurl') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Image File</label>

          <div class="col-md-6">
              <input type="file" required id="imageurl" name="imageurl">

              @if ($errors->has('imageurl'))
                  <span class="help-block">
                      <strong>{{ $errors->first('imageurl') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-success">
                  <i class="fa fa-btn fa-plus"></i> Add Product
              </button>
          </div>
      </div>
  </form>
</div>

@endsection 