@extends('layouts.master')
@section('content')
	<!--contact start here-->
<div class="contact">
	<div class="container">
		<div class="contact-main">
			<div class="contact-top aboutContent">
				<h1>About Us</h1>
				<p>@forelse ($aboutContent as $element)
					{{-- using html encoded text --}}
					{!! $element->about_content !!}
				@empty
					No data found
				@endforelse
			</p>
			</div>
			
		  <div class="clearfix"> </div>
		</div>
<br><br>
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Our Team</h1>
				<div class="home-block">
					<div class="container">
						<div class="home-block-main">
							@forelse ($team as $member)
								<div class="col-md-3 home-grid">
									<div class="home-product-main">
									   <div class="home-product-top">
									      <a href="#"><img src="{{ asset('theme_assets/images') }}/h1.jpg" alt="" class="img-responsive zoom-img"></a>
									   </div>
										<div class="home-product-bottom">
												<h3><a href="single.html">{{$member->name}}</a></h3>
												<p>{{$member->designation}}</p>						
										</div>
										<div class="srch">
											<span>Exp: {{$member->experience}}</span>
										</div>
									</div>
								</div>
							@empty
								No data found.
							@endforelse
							
							
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<!--contact end here-->
@endsection