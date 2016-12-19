@extends('layouts.index')

@section('title', 'Register as Customer')

@section('top-navigation')
<li>HOME</li>
@endsection

@section('sidebar-menu')
@endsection

@section('panel-title', 'REGISTER AS ADMIN')

@section('panel-body')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
          <label for="firstname" class="col-md-4 control-label">First Name</label>

          <div class="col-md-6">
              <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

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
              <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

              @if ($errors->has('lastname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('lastname') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('bday') ? ' has-error' : '' }}">
          <label for="bday" class="col-md-4 control-label">Birth Date</label>

          <div class="col-md-6">
              <input id="bday" type="date" class="form-control" name="bday" value="{{ old('bday') }}">

              @if ($errors->has('bday'))
                  <span class="help-block">
                      <strong>{{ $errors->first('bday') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
          <label for="contact" class="col-md-4 control-label">Contact No.</label>

          <div class="col-md-6">
              <input id="contact" type="varchar" class="form-control" name="contact" value="{{ old('contact') }}">

              @if ($errors->has('contact'))
                  <span class="help-block">
                      <strong>{{ $errors->first('contact') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
          <label for="address" class="col-md-4 control-label">Address</label>

          <div class="col-md-6">
              <input id="address" type="varchar" class="form-control" name="address" value="{{ old('address') }}">

              @if ($errors->has('address'))
                  <span class="help-block">
                      <strong>{{ $errors->first('address') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-Mail Address</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
              <input id="password" type="password" class="form-control" name="password">

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
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

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
                      <input type="hidden" name="isadmin" value="0">
                  </label>
              </div>
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> Register as Customer
              </button>
          </div>
      </div>
  </form>
</div>
@endsection
