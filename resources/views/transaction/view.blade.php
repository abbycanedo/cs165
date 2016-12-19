@extends('layouts.index')

@section('title', 'Transactions')

@section('panel-title', 'Transactions')

@section('panel-body')
@if(Auth::user()->isadmin==1)
  <div class="content-row">
    <form class="form-horizontal" role="form" method="POST" action="">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label"></label>
            <div class="col-md-6">
              <h5 class="content-row-title">View Customer Transactions</h5>
            </div>
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="user_id" class="col-md-4 control-label">Customer Email Address</label>
            <div class="col-md-6">
              <select required id="user_id" type="text" class="form-control" name="user_id">
                <option value="None" selected disabled>Select Customer Email</option>
                @foreach($profiles as $profile)
                  <option value="{{$profile->id}}">{{$profile->email}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-eye"></i> View User Transaction
                </button>
            </div>
        </div>
    </form>
  </div>
  <hr class="dashed" />  
  <div class="content-row">
    <a href="{{route('transaction.add', Auth::user()->getKey())}}" class="btn btn-success f-right">
      <i class="fa fa-btn fa-plus"></i> New Transaction
    </a>
  </div>
@endif
<div class="content-row">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th align="center">Date</th>
          <th align="center">Number</th>
          @if($isadmin == 1)
          	<th align="center">Customer Email</th>
          @else
          	<th align="center">Processed By</th>
          @endif
          <th align="center">Order Details</th>
          <th align="center">Total</th>
        </tr>
      </thead>
      <tbody>
      	@foreach($transactions as $transaction)
          <tr>
            <td>{{$transaction->created_at}}</td>
            <td>{{$transaction->transaction_no}}</td>
            <td>{{$transaction->email}}</td>
            <td>
              @foreach($carts as $cart)
                @if($cart->transaction_no == $transaction->transaction_no)
                  {{$cart->code}}
                  <ul>
                    <li>Brand: {{$cart->brand}}</li>
                    <li>Name: {{$cart->name}}</li>
                    <li>Price: {{$cart->price}}</li>
                  </ul>
                @endif
              @endforeach
            </td>
            <td>{{$transaction->total}}</td>
          </tr>
      	@endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection 