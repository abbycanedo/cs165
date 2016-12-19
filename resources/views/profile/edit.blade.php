@extends('layouts.index')

@section('title')
{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}
@endsection

@section('top-navigation')
@endsection

@section('sidebar-menu')
@endsection

@section('panel-title')
{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}'s Profile
@endsection

@section('panel-body')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.update', Auth::user()->getKey()) }}">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label"></label>
          <div class="col-md-6">
            <h5 class="content-row-title">Edit Profile</h5>
          </div>
      </div>

      @if(Auth::user()->isadmin == 1)
        <input id="isadmin" type="hidden" class="form-control" name="isadmin" value="1">
      @else
        <input id="isadmin" type="hidden" class="form-control" name="isadmin" value="0">
      @endif

      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
          <label for="firstname" class="col-md-4 control-label">First Name</label>

          <div class="col-md-6">
              <input required id="firstname" type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname}}">
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
              <input required id="lastname" type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname}}">

              @if ($errors->has('lastname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('lastname') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      @if (Auth::user()->isadmin == FALSE)
        @foreach($profiles as $profile)
          <div class="form-group{{ $errors->has('bday') ? ' has-error' : '' }}">
              <label for="bday" class="col-md-4 control-label">Birth Date</label>

              <div class="col-md-6">
                  <input required id="bday" type="date" class="form-control" name="bday" value="{{$profile->bday}}">

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
                  <input required id="contact" type="varchar" class="form-control" name="contact" value="{{$profile->contact}}">

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
                  <input required id="address" type="varchar" class="form-control" name="address" value="{{$profile->address}}">

                  @if ($errors->has('address'))
                      <span class="help-block">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
        @endforeach
      @endif


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-mail Address</label>

          <div class="col-md-6">
              <input required id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email}}">

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

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-success">
                  <i class="fa fa-btn fa-edit"></i> Save Profile Changes
              </button>
          </div>
      </div>
  </form>

  <hr class="dashed" />

  <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.password', Auth::user()->getKey()) }}">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label"></label>
          <div class="col-md-6">
            <h5 class="content-row-title">Change Password</h5>
          </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Current Password</label>

          <div class="col-md-6">
              <input required id="password" type="password" class="form-control" name="password">

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
          <label for="new_password" class="col-md-4 control-label">New Password</label>

          <div class="col-md-6">
              <input required id="new_password" type="password" class="form-control" name="new_password">

              @if ($errors->has('new_password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('new_password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

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
              <button type="submit" class="btn btn-success">
                  <i class="fa fa-btn fa-edit"></i> Save New Password
              </button>
          </div>
      </div>
  </form>


</div>
@endsection
