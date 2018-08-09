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
		  $('#datetimepicker').datetimepicker({
		  	format: 'dd-mm-yyyy hh:ii',
		  	autoclose:true,
		  	startDate:new Date()
		  });
		  $('#datetimepicker1').datetimepicker({
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
					    <li data-thumb="{{ asset('theme_assets') }}/images/si1.jpg">
					        <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s1.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li>
					    <li data-thumb="{{ asset('theme_assets') }}/images/si2.jpg">
					         <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s2.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li>
					    <li data-thumb="{{ asset('theme_assets') }}/images/si3.jpg">
					       <div class="thumb-image"> <img src="{{ asset('theme_assets') }}/images/s3.jpg" data-imagezoom="true" class="img-responsive"> </div>
					    </li> 
					  </ul>
				</div>
				</div>
				<div class="col-md-7 single-top-left simpleCart_shelfItem">
					<h2>Undercover</h2>
					<h1>Bike Name</h1>
					<h3>Model Name</h3>
					<h6 class="item_price">&#8377;100/Hour</h6>			
					<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p><br>
					<button type="button" class="btn btn-danger btn-lg" value="Book" data-toggle="modal" data-target="#myModal">Book</button>
				</div>
			<form id="booking_request_form" method="POST" action="#">
				{{ csrf_field() }}
				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Booking Request Form</h4>
				      </div>
				      <div class="modal-body">
			        	<div class="form-group">
				            <label for="email">Full Name</label>
				            <input type="text" class="form-control" id="name" name="name" required="required">
			          	</div>
			          	<div class="form-group">
				            <label for="pwd">Email</label>
				            <input type="email" class="form-control" id="email" name="email" required="required">
			          	</div>
          	          	<div class="form-group">
          		            <label for="pwd">Mobile</label>
          		            <input type="text" class="form-control" id="mobile" name="mobile" required="required"  onkeypress="return isNumber(event)" maxlength="10">
          	          	</div>
          	          	<div class="form-group">
          		            <label for="pwd">Age</label>
          		            <input type="text" class="form-control" id="age" name="age" required="required" onkeypress="return isNumber(event)" maxlength="2">
          	          	</div>
          	          	<div class="form-group">
          		            <label for="pwd">Ride Start Date/Time</label>
          		            <div class='input-group date' id='startTimeDatePicker'>
          		                    <input class="form-control text-box single-line" data-val="true" data-val-date="The field Date must be a date." data-val-required="The Date field is required." id="datetimepicker1" name="StartDate" type="datetime" value=""  required="required"/>
          		                    <span class="input-group-addon">
          		                      <span class="glyphicon glyphicon-calendar"></span>
          		                    </span>
          		                 </div>
          	          	</div>
				      
				      <div class="form-group">
          		            <label for="pwd">Ride End Date/Time</label>
          		            <div class='input-group date' id='startTimeDatePicker'>
          		                    <input class="form-control text-box single-line" data-val="true" data-val-date="The field Date must be a date." data-val-required="The Date field is required." id="datetimepicker" name="StartDate" type="datetime" value=""  required="required"/>
          		                    <span class="input-group-addon">
          		                      <span class="glyphicon glyphicon-calendar"></span>
          		                    </span>
          		                 </div>
          	          	</div>
          	          	<div class="form-group">
          		            <label for="pwd">Address</label>
          		            <textarea class="form-control" name="address" id="address" required="required"></textarea>
          	          	</div>
          	          	<div class="form-group">
          		            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Submit">
          	          	</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				<!-- End Modal -->
			</form>
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
@endsection