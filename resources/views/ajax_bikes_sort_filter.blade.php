 
  	@forelse ($get_all_bikes as $bike)
	      <div class="col-md-4 home-grid">
			<div class="home-product-main">
			   <div class="home-product-top">
			      <a href="{{ URL::to('/bike_single') }}"><img src="{{ asset('/theme_assets') }}/images/h19.jpg" alt="" class="img-responsive zoom-img"></a>
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
  	@empty
  		No Bike(s) found.
  	@endforelse
      
      
      <div class="clearfix"> </div>

      {{$get_all_bikes->links()}}
  