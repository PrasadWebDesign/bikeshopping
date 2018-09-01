@extends('layouts.master')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Checkout</h1>
				@include('layouts.messages')
			</div>

		</div>
		<div class="row">
			<div class="col-md-6">
				<h3>Billing Details</h3>
				<div class="form-group">
					<label for="Your Name:">Your Name</label> 
					<input type="text" name="name" id="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="Your Name:">Email</label>
					<input type="email" name="email" id="email" class="form-control">
				</div>
				<div class="form-group">
					<label for="Your Name:">Address</label>
					<input type="text" name="address" id="address" class="form-control">
				</div>
				<div class="form-group">
					<label for="Your Name:">City</label>
					<input type="text" name="city" id="city" class="form-control">
				</div>
				<div class="form-group">
					<label for="Your Name:">State</label>
					<input type="text" name="state" id="state" class="form-control">
				</div>
				<div class="form-group">
					<label for="Your Name:">Pincode</label>
					<input type="text" name="pincode" id="pincode" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="btnSubmit" value="Submit" class="btn btn-danger">
				</div>
				
				

				


			</div>
			<div class="col-md-6">
				<h3>Your Order</h3>
				<table class="table table-bordered">
					@foreach (Cart::content() as $item)
					{{-- {{dd($item)}} --}}
						<tr>
							<td><img src="{{ asset('storage/bikes/'.$item->model->cover_image) }}" alt="" width="100px"></td>
							<td>
								<p>{{$item->model->bike_title}}</p>
							</td>
							<td><p>&#8377; {{$item->model->hourly_rate}}/-</p></td>
						</tr>
					@endforeach
					
				</table>
				<table class="table">
					<tr>
						<td>Subtotal:</td>
						<td>&#8377; {{Cart::subtotal()}}/-</td>
					</tr>
					@if (session()->has('coupon'))
					<tr>
						<td>Coupon ({{session()->get('coupon')['name']}}): 
						<form action="{{ route('coupon.destroy') }}" method="post" style="display: inline;">
							@csrf
							{{ method_field('delete') }}
							<button type="submit">Remove</button>
						</form>
						</td>
						<td>less &#8377; {{$discount}}/-</td>
					</tr>
					<hr>
					<tr>
						<td>New Subtotal:</td>
						<td>&#8377; {{$newSubtotal}}/-</td>
					</tr>
					@endif
					<tr>
						<td>Tax:</td>
						<td>&#8377; {{$newTax}}/-</td>
					</tr>
					<tr>
						<td>Total:</td>
						<td>&#8377; {{$newTotal}}/-</td>
					</tr>
				</table>
				@if (!session()->has('coupon'))
				<h3>Have a coupon?</h3>
				<table class="table">
						<tr>
							<td>
							<form action="{{ route('coupon.store') }}" method="post">
								@csrf
								<input type="text" name="coupon_code" id="coupon_code" class="form-control" style="width:200px;display: inline-block!important;">
								<input type="submit" name="checkCoupon" id="checkCoupon" class="btn btn-danger" style="display: inline-block;">
								</form>
							</td>
							<td></td>
						</tr>
						
				</table>
				@endif	
			</div>
		</div>
	</div>
@endsection