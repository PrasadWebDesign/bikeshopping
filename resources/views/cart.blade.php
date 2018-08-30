@extends('layouts.master')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="ckeckout">
			<div class="container">
				@include('layouts.messages')
				<br>
				@if (Cart::count() > 0 )
					{{-- expr --}}
				
				<div class="ckeckout-top">
				<div class=" cart-items heading">
				 <h1>My Shopping Bag ({{Cart::count()}})</h1>
					{{-- <script>$(document).ready(function(c) {
						$('.close1').on('click', function(c){
							$('.cart-header').fadeOut('slow', function(c){
								$('.cart-header').remove();
							});
							});	  
						});
				   </script>
				<script>$(document).ready(function(c) {
						$('.close2').on('click', function(c){
							$('.cart-header1').fadeOut('slow', function(c){
								$('.cart-header1').remove();
							});
							});	  
						});
				   </script>
				   <script>$(document).ready(function(c) {
						$('.close3').on('click', function(c){
							$('.cart-header2').fadeOut('slow', function(c){
								$('.cart-header2').remove();
							});
							});	  
						});
				   </script> --}}
					
				<div class="in-check" >
					<ul class="unit">
						<li><span>Bike Image</span></li>
						<li><span>Bike Name</span></li>		
						<li><span>Price</span></li>
						{{-- <li><span>Tax(18%)</span></li> --}}
						
						<li> </li>
						<div class="clearfix"> </div>
					</ul>

					@foreach (Cart::content() as $item)
						{{-- expr --}}
					
					<ul class="cart-header simpleCart_shelfItem">
						
						
							<li class="ring-in"><a href="{{ route('bikes.show_single_bike', $item->model->id) }}" ><img src="{{asset('storage/bikes/'.$item->model->cover_image)}}" class="img-responsive" alt=""></a>
							</li>
							<li><span>{{$item->model->bike_title}}</span></li>
							<li><span class="item_price">&#8377; {{$item->model->hourly_rate}}/-</span></li>
							{{-- <li><span>&#8377; {{Cart::tax()}}/-</span></li> --}}
							<form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
							@csrf
							{{method_field('DELETE')}}
							<button type="submit" class="btn btn-sm btn-danger"> Remove</button>
						</form>				
						<div class="clearfix"> </div>
					</ul>
					@endforeach
					{{-- <ul class=" cart-header1 simpleCart_shelfItem">
						<div class="close2"> </div>
							<li class="ring-in"><a href="single.html" ><img src="images/c2.jpg" class="img-responsive" alt=""></a>
							</li>
							<li><span>Watches</span></li>
							<li><span class="item_price">$ 300.00</span></li>
							<li> <a href="#" class="add-cart cart-check item_add">Add to cart</a></li>						
							<div class="clearfix"> </div>
					</ul>
					<ul class="cart-header2 simpleCart_shelfItem">
						<div class="close3"> </div>
							<li class="ring-in"><a href="single.html" ><img src="images/c3.jpg" class="img-responsive" alt=""></a>
							</li>
							<li><span>Handbag</span></li>
							<li><span class="item_price">$ 360.00</span></li>
							<li> <a href="#" class="add-cart cart-check item_add">Add to cart</a></li>						
							<div class="clearfix"> </div>
					</ul> --}}
					<div class="row">
						<div class="col-md-8">
							
						</div>
						<div class="col-md-4">
							<h3>Subtotal : &#8377; {{Cart::subtotal()}}/- </h3>
							<h3>Tax(18%) : &#8377; {{Cart::tax()}}/- </h3>
<hr>
							<h3>Total    :  &#8377; {{Cart::total()}}/- </h3>
<br>
<a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg">Checkout</a>
						</div>
					</div>
				</div>
				</div>  
			 </div>

			 @else
			 	<h3>No Items in your Cart</h3>
			 @endif
			</div>
		</div>
@endsection

@section('footer')
	{{-- expr --}}
@endsection