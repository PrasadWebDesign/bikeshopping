@extends('layouts.master')
@section('header')
	<!--flex slider-->
	<script defer src="{{ asset('theme_assets') }}/js/jquery.flexslider.js"></script>
	<link rel="stylesheet" href="{{ asset('theme_assets') }}/css/flexslider.css" type="text/css" media="screen" />

	<script>
	// Can also be used with $(document).ready()
	$(window).load(function() {
	  $('.flexslider').flexslider({
	    animation: "slide",
	    controlNav: "thumbnails"
	  });
	});
	</script>
	<!--flex slider-->
	<script src="{{ asset('theme_assets') }}/js/imagezoom.js"></script>

	{{-- <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('theme_assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
	<script src="{{ asset('theme_assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
	<script>
		$(function() {
		  $('#ride_end_date').datetimepicker({
		  	format: 'dd-mm-yyyy hh:ii',
		  	autoclose:true,
		  	startDate:new Date()
		  });
		  $('#ride_start_date').datetimepicker({
		  	format: 'dd-mm-yyyy hh:ii',
		  	autoclose:true,
		  	startDate:new Date()
		  });
		});

		function isNumber(evt) {
		    evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		}
	</script>
	<style type="text/css">
		.border {
		    border: 1px solid #dee2e6;
		}
		.border-danger {
		    border-color: #dc3545!important;
		}
		.modal_loader
        {
            position: fixed;
            z-index: 999;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background-color: white;
            filter: alpha(opacity=60);
            opacity: 0.6;
            -moz-opacity: 0.8;
        }
        .center
        {
            z-index: 1000;
            margin: 40vh auto;
            padding: 10px;
            width: 130px;
            background-color: transparent;
            border-radius: 10px;
            filter: alpha(opacity=100);
            opacity: 1;
            -moz-opacity: 1;
        }
        .center img
        {
            /*        height: 200px;
                    width: 300px;*/
        }
	</style>
@endsection

@section('content')
	<!--single start here-->
	<div class="single">
	   <div class="container">
	   	 <div class="single-main">
	   	 	<div class="single-top-main">
		   		<div class="col-md-5 single-top">	
				   <div class="flexslider">
					  <ul class="slides">
					  	@forelse ($bike_other_images as $image)
					  		<li data-thumb="{{ asset('storage/bikes') }}/{{$image}}">
						        <div class="thumb-image"> <img src="{{ asset('storage/bikes') }}/{{$image}}" data-imagezoom="true" class="img-responsive"> </div>
						    </li>
					  	@empty
					  		<li data-thumb="{{ asset('storage/bikes') }}/noimage.jpg">
						        <div class="thumb-image"> <img src="{{ asset('storage/bikes') }}/noimage.jpg" data-imagezoom="true" class="img-responsive"> </div>
						    </li>
					  	@endforelse
					    {{-- <li data-thumb="{{ asset('theme_assets') }}/images/si1.jpg">
					        <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s1.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li>
					    <li data-thumb="{{ asset('theme_assets') }}/images/si2.jpg">
					         <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s2.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li>
					    <li data-thumb="{{ asset('theme_assets') }}/images/si3.jpg">
					       <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s3.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li>  --}}
					  </ul>
				</div>
				</div>
				<div class="col-md-7 single-top-left simpleCart_shelfItem">
					{{-- <h2>Undercover</h2> --}}
					<h1>{{$bike->bike_title}}</h1>
					
					<h6 class="item_price">&#8377;{{$bike->hourly_rate}}/Hour</h6>			
					{!!$bike->description!!}
					<br>
					{{-- for server side ajax validation --}}
					{{-- <button type="button" class="btn btn-danger btn-lg" value="Book" data-toggle="modal" data-target="#myModal">Book</button> --}}
					{{-- for cart --}}
					<form action="{{ route('cart.store') }}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{$bike->id}}">
						<input type="hidden" name="name" value="{{$bike->bike_title}}">
						<input type="hidden" name="price" value="{{$bike->hourly_rate}}">
						<button type="submit" class="btn btn-danger btn-lg" value="Book">Book</button>
					</form>

					<form action="{{ route('wishlist.store') }}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{$bike->id}}">
						<input type="hidden" name="name" value="{{$bike->bike_title}}">
						<input type="hidden" name="price" value="{{$bike->hourly_rate}}">
						<button type="submit" class="btn btn-warning btn-lg" value="Add to WIshlist">Add to WIshlist</button>
					</form>
				</div>
			
			   <div class="clearfix"> </div>
		   </div>
		   <div class="singlepage-product">
			   	 <div class="col-md-3 home-grid">
						<div class="home-product-main">
						   <div class="home-product-top">
						      <a href="#"><img src="{{ asset('theme_assets') }}/images/h14.jpg" alt="" class="img-responsive zoom-img"></a>
						   </div>
							<div class="home-product-bottom">
									<h3><a href="#">Smart Shopping</a></h3>
									<p>Explore Now</p>						
							</div>
							<div class="srch">
								<span>$200</span>
							</div>
						</div>
					 </div>
				      <div class="col-md-3 home-grid">
						<div class="home-product-main">
						   <div class="home-product-top">
						      <a href="#"><img src="{{ asset('theme_assets') }}/images/h15.jpg" alt="" class="img-responsive zoom-img"></a>
						   </div>
							<div class="home-product-bottom">
									<h3><a href="#">Smart Shopping</a></h3>
									<p>Explore Now</p>						
							</div>
							<div class="srch">
								<span>$200</span>
							</div>
						</div>
					 </div>
					 <div class="col-md-3 home-grid">
						<div class="home-product-main">
						   <div class="home-product-top">
						      <a href="#"><img src="{{ asset('theme_assets') }}/images/h16.jpg" alt="" class="img-responsive zoom-img"></a>
						   </div>
							<div class="home-product-bottom">
									<h3><a href="#">Smart Shopping</a></h3>
									<p>Explore Now</p>						
							</div>
							<div class="srch">
								<span>$200</span>
							</div>
						</div>
					 </div>
				      <div class="col-md-3 home-grid">
						<div class="home-product-main">
						   <div class="home-product-top">
						      <a href="#"><img src="{{ asset('theme_assets') }}/images/h17.jpg" alt="" class="img-responsive zoom-img"></a>
						   </div>
							<div class="home-product-bottom">
									<h3><a href="#">Smart Shopping</a></h3>
									<p>Explore Now</p>						
							</div>
							<div class="srch">
								<span>$200</span>
							</div>
						</div>
					 </div>
			  <div class="clearfix"> </div>
		   </div>
	   	 </div>
	   </div>
	</div>
	<!--single end here-->

	<script type="text/javascript">
		// (function () {
		// 	$('#booking_request_form').submit(function(e){
		// 		e.preventDefault();
		// 		$.ajaxSetup({
		// 		  headers: {
		// 		    'X-Request-With': 'XMLHttpRequest'
		// 		  },
		// 		  global: false,
		// 		  beforeSend: function () {
		// 		      $(".modal_loader").show();
		// 		  },
		// 		  complete: function () {
		// 		      $(".modal_loader").hide();
		// 		  }
		// 		});
		// 		$.ajax({
		// 			type:'post',
		// 			url:'{{URL::to('/booking_request')}}',
		// 			data:{
		// 				name:$('#name').val(),
		// 				email:$('#email').val(),
		// 				mobile:$('#mobile').val(),
		// 				age:$('#age').val(),
		// 				ride_start_date:$('#ride_start_date').val(),
		// 				ride_end_date:$('#ride_end_date').val(),
		// 				address:$('#address').val(),
		// 				"_token":"{{csrf_token()}}",
		// 				bike_id:$('#bike_id').val(),
		// 				bike_hourly_rate:$('#bike_hourly_rate').val()

		// 			},
		// 			cache:false,
		// 			dataType:'json',
		// 			success:function(resp){
		// 				$('.messageDiv').html(resp.status).show();
						
		// 			},
		// 			// 
		// 			error:function (jqXHR, textStatus, errorThrown) {
		// 				// console.error(jqXHR);
		// 				const error = jqXHR.responseJSON.errors;

		// 				const firstItem = Object.keys(error)[0];
		// 				const firstItemDOM = document.getElementById(firstItem);
		// 				const firstErrorMessage = error[firstItem][0];

		// 				// scroll into that error field
		// 				// firstItemDOM.scrollIntoView({behavior:'smooth'});
		// 				firstItemDOM.scrollIntoView();

		// 				clearErrors();

		// 				// show error message
		// 				firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger"><b>${firstErrorMessage}</b></div>`);
						

		// 				// highlight the form control with the error
  //                   	firstItemDOM.classList.add('border', 'border-danger')	
		// 			}
		// 		});
		// 	});
		// 	function clearErrors() {
  //               // remove all error messages
  //               const errorMessages = document.querySelectorAll('.text-danger')
  //               errorMessages.forEach((element) => element.textContent = '')
  //               // remove all form controls with highlighted error text box
  //               const formControls = document.querySelectorAll('.form-control')
  //               formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
  //           }
		// })();
	</script>
@endsection

@section('footer')
	<div class="modal modal_loader" style="display: none">
	        <div class="center">
	            <img alt="" src="{{ asset('theme_assets/images/ajax-l2.gif') }}" />
	        </div>
	    </div>
@endsection