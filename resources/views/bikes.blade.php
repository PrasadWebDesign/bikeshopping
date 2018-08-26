@extends('layouts.master')
@section('header')
<link rel="stylesheet" href="{{ asset('theme_assets') }}/css/bootstrap-slider.css" type="text/css" media="screen" />
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="{{ asset('') }}theme_assets/js/jquery.jscrollpane.min.js"></script>
			<script type="text/javascript" id="sourcecode">
				$(function()
				{
					$('.scroll-pane').jScrollPane();
				});
			</script>

<style type="text/css">
	#ex1Slider .slider-selection {
	background: #BABABA;
}
</style>
	<!-- //the jScrollPane script -->
@endsection

@section('content')
	<!--product start here-->
	<div class="product"  >
		<div class="container">
			<div class="product-main">

				  <div class=" product-menu-bar">
				    <div class="col-md-3 prdt-right">
						<div class="w_sidebar">
							<section  class="sky-form">
								<h1>Sort By</h1>
								<div class="row1 scroll-pane">
									<div class="col col-4">								
										<div class="slidecontainer">
										  	<p>Sort By Rates</p>
										  	<select name="sortbybikes" id="sortbybikes" >
										  		<option>SELECT</option>
			                                    <option value="rate-asc-rank">Rate: Low to High</option>
			                                    <option value="rate-desc-rank">Rate: High to Low</option>
			                                    <option value="id-desc-rank">Newest</option>
			                                    <option value="id-asc-rank">Oldest</option>
		                                    </select>
										</div>			
									</div>
								</div>
							</section>


							<section  class="sky-form">
								<h1>Price</h1>
								<div class="row1 scroll-pane">
									<div class="col col-4">	

										<b>{{$min_rate}}</b> <input id="ex2" type="text" class="span2 pricerangesliderbikes" value="" data-slider-min="{{$min_rate}}" data-slider-max="{{$max_rate}}" data-slider-step="50" data-slider-value="[{{$min_rate}},{{$max_rate}}]"/> <b> {{$max_rate}}</b>

										<!-- <input id="ex1" class="pricerangesliderbikes" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="500" data-slider-step="50" data-slider-value="200"/> -->

								</div>
							</section>
						</div>
					</div>
				  </div>	

				  <div class="col-md-9 product-block" id="product-block">
				  	<?php $i=1; ?>

				  	@forelse ($bikes as $bike)
		  		      <div class="col-md-4 home-grid">
		  				<div class="home-product-main">
		  				   <div class="home-product-top">
		  				      <a href="{{ URL::to('/bike_single')}}/{{$bike->id }}"><img src="{{ asset('/storage/bikes') }}/{{$bike->cover_image}}" alt="" class="img-responsive zoom-img" ></a>
		  				   </div>
		  					<div class="home-product-bottom">
		  							<h3><a href="{{ URL::to('/bike_single/') }}/{{$bike->id}}">{{ $bike->bike_title }}</a></h3>
		  							<p>Rate: &#8377;{{$bike->hourly_rate}}/Hour</p>						
		  					</div>
		  					<div class="srch">
		  						<span>$200</span>
		  					</div>
		  				</div>
		  			 </div>
					<?php 
					if(($i%3)==0) 
					{
						echo '<div class="clearfix"> </div>';
					}
					$i++;
					?>
				  	@empty
				  		No Bike(s) found.
				  	@endforelse
				      
				      
				      <div class="clearfix"> </div>
				          <!--  {{$bikes->appends(request()->input())->links()}} -->
				          {{$bikes->links()}}

				  </div>
			</div>
		</div>
	</div>
	<!--product end here-->
<script type="text/javascript" src="{{ asset('') }}theme_assets/js/bootstrap-slider.js"></script>
<script type="text/javascript">
		$('document').ready(function(){
//Tooltip of range slider
			$('#ex1').slider({
				formatter: function(value) {
					return 'Current value: ' + value;
				}
			});

			$("#ex2").slider({});


// $('.page-link').on('click', function(e){
//     e.preventDefault();
//     alert('pagination');
//     //var url = $(this).attr('href');
//     var url = $(this).attr('href'),
//         page = url.split('page=')[1];
//     var url = '{{URL::to('/bike_filter')}}'+'?page='+page;
//     $.get(url, { sort_by_bikes: $('#sortbybikes').val(), _token: "{{csrf_token()}}"	}, function(data){
//         $('#product-block').html(data);
//     });
// });



//Sort by Rates bikes
			$('#sortbybikes').change(function(){

				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

				  }
				});
				$.ajax({
					type:'GET',
					url:'{{URL::to('/bike_filter')}}',
					data:{ 
						sort_by_bikes: $(this).val(),
						_token: "{{csrf_token()}}",
						},
					Accept : 'application/json',
					 async : true,
					success:function(resp){
						$('#product-block').html(resp);
						
					}
				});
			});

// Price range slider
			$('.pricerangesliderbikes').change(function(){

				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				$.ajax({
					type:'POST',
					url:'{{URL::to('/bike_price_filter')}}',
					data:{ 
						price_range: $(this).val(),
						_token: "{{csrf_token()}}",
						},
					Accept : 'application/json',	
					success:function(resp){
						$('#product-block').html(resp);
					}
				});
			});
		});
	</script>
@endsection

