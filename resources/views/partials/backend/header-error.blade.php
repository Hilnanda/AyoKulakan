<header class="header-style-1">
	<div class="top-bar animate-dropdown" style="background: #504F4F">
		<div class="container">
			<div class="header-top-inner">
				@if(Auth::check())
					
					<div class="cnt-block">
			          <ul class="list-unstyled list-inline">
			            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">My Account </span><b class="caret"></b></a>
			              <ul class="dropdown-menu">
			                <li><a href="{{ url('/myprofile') }}">Profile</a></li>
			                <li><a href="{{ url('/logout') }}">Logout</a></li>
			              </ul>
			            </li>
			          </ul>
			        </div>			
				@else
					<div class="cnt-account">
						<ul class="list-unstyled">
							<li><a href="javascript:void(0)"></a></li>
							<li><a href="{{ url('register') }}"><i class="icon fa fa-user"></i>Register</a></li>
							<li><a href="{{ url('login') }}"><i class="icon fa fa-lock"></i>Login</a></li>
						</ul>
					</div>
				@endif
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="main-header" style="background: #504F4F">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<div class="logo">
						<a href="{{url('/')}}"><img src="{{ asset('img/logo/logo-long.png') }}" alt="Ayokulakan" style="height: 60px;width: 250px;position: relative;bottom: 13px">
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">			
					<div class="search-area">
						<form action="{{ url('sc/barang') }}">
							<div class="control-group">
								<input type="text" name="search_ampas" class="search-field" placeholder="Cari Produk...">
								<button class="search-button"></button>
							</div>
						</form>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
					<div class="dropdown dropdown-cart">
						<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
							<div class="items-cart-inner">
								<div class="basket">
									<i class="glyphicon glyphicon-shopping-cart"></i>
								</div>
								<div class="basket-item-count"><span class="count">0</span></div>
								<div class="total-price-basket">
									<span class="lbl">cart</span>
								</div>
							</div>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="cart-item product-summary">
									<div class="row">
										<div class="col-xs-4">
											<div class="image">
												<a href="detail.html"><img src="{{ asset("new_temp/images/cart.jpg") }}" alt=""></a>
											</div>
										</div>
										<div class="col-xs-7">

											<h3 class="name"><a href="index.php?page-detail">Simple Product</a></h3>
											<div class="price">$600.00</div>
										</div>
										<div class="col-xs-1 action">
											<a href="#"><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<hr>

								<div class="clearfix cart-total">
									<div class="pull-right">

										<span class="text">Sub Total :</span><span class='price'>$600.00</span>

									</div>
									<div class="clearfix"></div>

									<a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
								</div>


							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>

	</div>


	<div class="header-nav animate-dropdown" style="background:#59b210">
		<div class="container">
			<div class="yamm navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="nav-bg-class">
					<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
						<div class="nav-outer">
							<ul class="nav navbar-nav">
								@if(isset($mainMenuFrontEnd))
		                            @foreach($mainMenuFrontEnd->roots() as $key => $value)
		                            	@if($value->hasChildren())
		                            		<li class="dropdown">
												<a href="{!! $value->url() !!}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown" style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}" tabindex="{{ $value->id }}">
													{!! $value->title !!} <i class="{{ $value->icon }}"></i>
												</a>
												<ul class="dropdown-menu pages">
													<li>
														<div class="yamm-content">
															<div class="row">
																<div class="col-xs-12 col-menu">
																	<ul class="links">
																	@foreach ($value->children() as $k => $child)
																		<li>
																			<a href="{{$child->url()}}" style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!! $child->title !!}</a>
																		</li>
																	@endforeach
																	</ul>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</li>
		                            	@else
				                            <li class="dropdown yamm-fw">
												<a href="{!! $value->url() !!}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown" style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}" tabindex="{{ $value->id }}">
													{!! $value->title !!} <i class="{{ $value->icon }}"></i>
												</a>
											</li>
		                            	@endif
				                	</li>
		               				@endforeach
		                		@endif
							</ul>
							<div class="clearfix"></div>				
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>


	</header>