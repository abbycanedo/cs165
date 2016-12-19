@extends('layouts.index')

@section('title', 'Log In')

@section('top-navigation')
<li>HOME</li>
@endsection

@section('sidebar-menu')
<li class="list-group-item">
  <a href="#" >
    <i class="glyphicon glyphicon-lock"></i>Login
  </a>
</li>
<li>
  <a href="#demo3" class="list-group-item " data-toggle="collapse">
    <i class="glyphicon glyphicon-user"></i>Register Account
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  <div class="collapse" id="demo3">
    <a href="#" class="list-group-item">Admin Account</a>
    <a href="#" class="list-group-item">Customer Account</a>
  </div>
</li>
@endsection

@section('panel-title', 'REGISTER AS ADMIN')

@section('panel-body')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
          <label for="firstname" class="col-md-4 control-label">First Name</label>

          <div class="col-md-6">
              <input required id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

              @if ($errors->has('firstname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('firstname') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
          <label for="lastname" class="col-md-4 control-label">Last Name</label>

          <div class="col-md-6">
              <input required id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

              @if ($errors->has('lastname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('lastname') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-mail Address</label>

          <div class="col-md-6">
              <input required id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Password</label>

          <div class="col-md-6">
              <input required id="password" type="password" class="form-control" name="password">

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

          <div class="col-md-6">
              <input required id="password-confirm" type="password" class="form-control" name="password_confirmation">

              @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="isadmin"> Admin?
                  </label>
              </div>
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> Register
              </button>
          </div>
      </div>
  </form>
</div>
@endsection
