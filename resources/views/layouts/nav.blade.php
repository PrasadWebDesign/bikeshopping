<nav class="navbar navbar-default" role="navigation">
					    <div class="navbar-header">
					        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
					        </button>
					        <div class="navbar-brand logo">
								<a href="{{ URL::to('/') }}"><img src="{{URL::to('/')}}/theme_assets/images/logo1.png" alt=""></a>
							</div>
					    </div>
					    <!--/.navbar-header-->
					 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					        <ul class="nav navbar-nav">
					        	   <li><a href="{{ URL::to('/') }}">Home</a></li>
						          <li><a href="{{ url::to('/about') }}">About</a></li>
						          <li><a href="{{ url::to('/bikes') }}">Bikes</a></li>   
						        <li><a href="{{ url::to('/contact') }}">Contact</a></li>
					        </ul>
					        <!-- Right Side Of Navbar -->
		                    {{-- <ul class="navbar-nav ml-auto">
		                        <!-- Authentication Links -->
		                        @guest
		                            <li class="nav-item">
		                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		                            </li>
		                            <li class="nav-item">
		                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
		                            </li>
		                        @else
		                            <li class="nav-item dropdown">
		                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
		                                    {{ Auth::user()->name }} <span class="caret"></span>
		                                </a>

		                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		                                    <a class="dropdown-item" href="{{ route('logout') }}"
		                                       onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                        {{ __('Logout') }}
		                                    </a>

		                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                        @csrf
		                                    </form>
		                                </div>
		                            </li>
		                        @endguest
		                    </ul> --}}
					    </div>
					    <!--/.navbar-collapse-->
					</nav>
					<!--/.navbar-->
				</div>
			</div>
			<div class="header-right">
				<div class="search">
					{{-- <div class="search-text">
					    <input class="serch" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"/>
					</div> --}}
					<div class="cart box_1">
						<a href="{{ route('cart.index') }}">
						<h3>
							<img src="{{ asset('theme_assets/images/cart.png') }}" alt=""/>
							@if (Cart::instance('default')->count() > 0 )
								<div class="total">
									<span class="simpleCart_total">{{ Cart::instance('default')->count()}}</span>
								</div>
							@endif
							
							</h3>

						</a>
						
					</div>  

					<div class="heart box_1">
						<a href="{{ route('wishlist.index') }}">
						<h3>
							<img src="{{ asset('theme_assets/images/cart.png') }}" alt=""/>
							@if (Cart::instance('wishlist')->count() > 0 )
								<div class="total">
									<span class="simpleCart_total">{{ Cart::instance('wishlist')->count()}}</span>
								</div>
							@endif
							
							</h3>
							
						</a>
						
					</div>     
					<div class="head-signin">
						@guest
						<h5><a href="{{ route('login') }}"><i class="hd-dign"></i> {{ __('Login') }}</a></h5>
						@else
						<h5><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}"><i class="hd-dign"></i></a></h5>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            	@csrf
                        	</form>
                    	@endguest
					</div>              
                     <div class="clearfix"> </div>					
				</div>
			</div>
		 <div class="clearfix"> </div>
		</div>