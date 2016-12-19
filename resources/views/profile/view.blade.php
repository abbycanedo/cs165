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
  <form class="form-horizontal" role="form">
      <div class="form-group{{ $errors->has('isadmin') ? ' has-error' : '' }}">
          <label for="isadmin" class="col-md-4 control-label">Account Type</label>
          <div class="col-md-6">
            @if(Auth::user()->isadmin == 1)
              ADMIN
            @else
              CUSTOMER
            @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
          <label for="firstname" class="col-md-4 control-label">First Name</label>
          <div class="col-md-6">
              {{ Auth::user()->firstname}}
          </div>
      </div>

      <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
          <label for="lastname" class="col-md-4 control-label">Last Name</label>
          <div class="col-md-6">
              {{ Auth::user()->lastname}}
          </div>
      </div>

      @if (Auth::user()->isadmin == FALSE)
        @foreach($profiles as $profile)
          <div class="form-group{{ $errors->has('bday') ? ' has-error' : '' }}">
              <label for="bday" class="col-md-4 control-label">Birth Date</label>
              <div class="col-md-6">
                {{$profile->bday}}
              </div>
          </div>

          <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
              <label for="contact" class="col-md-4 control-label">Contact No.</label>
              <div class="col-md-6">
                {{$profile->contact}}
              </div>
          </div>

          <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
              <label for="address" class="col-md-4 control-label">Address</label>
              <div class="col-md-6">
                {{$profile->address}}
              </div>
          </div>
        @endforeach
      @endif

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-mail Address</label>
          <div class="col-md-6">
              {{ Auth::user()->email}}
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <a href="{{ route('profile.edit', Auth::user()->getKey()) }}" type="submit" class="btn btn-default">
                  <i class="fa fa-btn fa-edit"></i> Edit Profile
              </a>
          </div>
      </div>

  </form>
</div>

@endsection