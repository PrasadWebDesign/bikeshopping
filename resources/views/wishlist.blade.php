
@extends('layouts.master')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="ckeckout">
			<div class="container">
				@include('layouts.messages')
				<br>
				@if (Cart::instance('wishlist')->count() > 0 )
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
						
						<li> </li>
						<div class="clearfix"> </div>
					</ul>

					@foreach (Cart::instance('wishlist')->content() as $item)
						{{-- expr --}}
					
					<ul class="cart-header simpleCart_shelfItem">
						
						
							<li class="ring-in"><a href="{{ route('bikes.show_single_bike', $item->model->id) }}" ><img src="{{asset('storage/bikes/'.$item->model->cover_image)}}" class="img-responsive" alt="image"></a>
							</li>
							<li><span>{{$item->model->bike_title}}</span></li>
							<li><span class="item_price">&#8377; {{$item->model->hourly_rate}}/-</span></li>
							{{-- <li><span>&#8377; {{Cart::tax()}}/-</span></li> --}}
							<form action="{{ route('wishlist.destroy',$item->rowId) }}" method="POST">
								@csrf
								{{method_field('DELETE')}}
								<button type="submit" class="btn btn-sm btn-danger"> Remove</button>
							</form>	

							<form action="{{ route('cart.store') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{$item->model->id}}">
								<input type="hidden" name="name" value="{{$item->model->bike_title}}">
								<input type="hidden" name="price" value="{{$item->model->hourly_rate}}">
								<button type="submit" class="btn btn-warning btn-sm" value="Add to Cart">Add to Cart</button>
							</form>			
						<div class="clearfix"> </div>
					</ul>
					@endforeach

				</div>
				</div>  
			 </div>

			 @else
			 	<h3>No Items in your Wishlist</h3>
			 @endif
			</div>
		</div>
@endsection

@section('footer')
	{{-- expr --}}
@endsection