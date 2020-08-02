<header class="header-style-1">
	<div class="top-bar animate-dropdown" style="">
		<div class="container">
			<div class="header-top-inner">
				@if(Auth::check())
				<div class="cnt-block">
						<ul class="list-unstyled list-inline">
							<li class="dropdown dropdown-small" style="padding-right: 65px !important"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
							data-toggle="dropdown"><span class="value">| My Account </span><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('/myprofile') }}">Profile</a></li>
									<li><a href="{{ url('/logout') }}">Logout</a></li>
									@if(Auth::check())
									@if(isset($mainMenu))
									<li class="dropdown dropdown-submenu">
									<a href="#" class="dropdown-toggle" data-hover="dropdown"
									data-toggle="dropdown">Pengaturan <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
										@foreach($mainMenu->roots() as $k => $item)
										@if(!$item->hasChildren())
											<li>
											<a href="{!! $item->url() !!}"
												style="{{ isset($title) ? ($item->title == $title ? 'color:red' : '') : '' }}"
												tabindex="{{ $item->id }}">{!! $item->title !!}</a>
											</li>
											@else
											<li class="dropdown dropdown-submenu">
												<a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"
												href="{!! $item->url() !!}"
												style="{{ isset($title) ? ($item->title == $title ? 'color:red' : '') : '' }}"
												tabindex="-1">{!! $item->title !!} <i class="fa fa-angle-down"></i></a>
												<ul class="dropdown-menu" style="max-height: 250px;overflow: scroll;">
													@foreach ($item->children() as $k => $child)
													<li><a tabindex="-1" href="{!! $child->url() !!} ">{!! $child->title
													!!}</a></li>
													@endforeach
												</ul>
											</li>
											@endif
											@endforeach
										</ul>
									</li>
									@endif
									@endif
								</ul>
							</li>
						</ul>
					</div>
					@endif
					<div class="cnt-account" style="text-align:center">
						<ul class="list-unstyled list-inline">
							<li class="dropdown dropdown-small">
								<a class="dropdown-toggle" data-hover="dropdown"
								data-toggle="dropdown" href="#"><span> Tentang </span></a>
								<ul class="dropdown-menu">
									<div style="display: block; padding:5px">
										<li style="margin-bottom:10px !important"><a href="{{ url('/tentang') }}" style="color: black; list-style:none;">Ayokulakan</a></li>
										<li style="margin-bottom:10px !important"><a href="{{ route('kaki-lima') }}" style="color: black; list-style:none;">Kaki Lima</a></li>
										<li style="margin-bottom:10px !important"><a href="{{ route('kurir-tentang') }}"  style="color: black; list-style:none;">Kurir</a></li>
									</div>
								</ul>
							</li>
							<li>
								<a href="{{ url('/aturan-pengguna') }}">
									<span> Aturan Pengguna </span>
								</a>
							</li>
							<li>
								<a href="{{ url('/perjanjian') }}">
									<span> Perjanjian </span>
								</a>
							</li>
							<li>
								<a href="{{ url('/syarat-dan-ketentuan') }}">
									<span> Syarat dan Ketentuan </span>
								</a>
							</li>
							<li>
								<a href="{{ url('/kebijakan-privasi') }}">
									<span> Kebijakan Privasi </span>
								</a>
							</li>
							<li>
								<a href="{{ url('/kontak-kami') }}">
									<span> Kontak Kami </span>
								</a>
							</li>
							@if(Auth::check())
							<li>
								<a href="javascript:void(0)" class="show-front shows" data-url="{{ url('mess-not/show-all') }}">
									<i class="icon fa fa-bell"></i>
									{{ count($notifFeedback) }} Notifikasi
								</a>
							</li>
							<li>
								<a class="" target="_blank" href="{{ url('chat') }}">
									<i class="icon fa fa-comment"></i>
									<span class="notifChat"> {{ $notifChat }} Pesan</span>
								</a>
							</li>
							<li>
								<a href="{{ url('airline/booking') }}">
									<i class="icon fa fa-plane"></i>
									<span> Booking List </span>
								</a>
							</li>
							@else
							<li><a href="{{ url('register') }}"><i class="icon fa fa-user"></i>Register</a></li>
							<li><a href="{{ url('login') }}"><i class="icon fa fa-lock"></i>Login</a></li>
							@endif
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="main-header" style="">
			<div class="row">
				@if(!Auth::check())
				<div class="container">
					<div class="col-xs-12 col-sm-12 col-md-4 logo-holder">
						<div class="logo">
							<a href="{{url('/')}}"><img src="{{ asset('img/logo/logo-long.png') }}" alt="Ayokulakan" style="height: 60px;width: 250px;position: relative;bottom: 13px">
							</a>
							<a style="display: block; color: white;" href="https://covid.lpxhbest.com/webui-m-misc/covid-home/index.html?invite_code=K64UG">
								<span> Informasi Covid-19 Disini </span>
							</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-8 top-search-holder">
						@if (isset($rental))
							<div class="search-area">
								<form action="{{ route('search-rental') }}">
									<div class="control-group">
										<input type="text" name="search_rental" class="search-field"
										placeholder="Cari Produk..." style="width:90%">
										<button class="search-button"></button>
									</div>
								</form>
							</div>
						@else
						<div class="search-area">
							<form action="{{ url('sc/barang') }}">
								<div class="control-group">
									<input type="text" name="search_ampas" class="search-field"
									placeholder="Cari Produk..." style="width:90%">
									<button class="search-button"></button>
								</div>
							</form>
						</div>
						@endif
					</div>
					<!-- <div class="col-xs-4 col-sm-4 col-md-2 animate-dropdown top-cart-row">
							<div class="dropdown dropdown-cart">
								<a href="javascript:void(0)" class="dropdown-toggle lnk-cart show-front shows"
									data-url="{{ url('keranjang/show') }}">
									<div class="items-cart-inner">
										<div class="basket">
											<i class="glyphicon glyphicon-shopping-cart"></i>
										</div>
										<div class="basket-item-count"><span class="count">{{ count($keranjang) }}</span></div>
										<div class="total-price-basket">
											<span class="lbl" style="font-size: 10px;">Keranjang Barang</span>
										</div>
									</div>
								</a>
							</div>
					</div> -->
				</div>
			@else
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-2 logo-holder">
					<div class="logo">
						<a href="{{url('/')}}"><img src="{{ asset('img/logo/logo-long.png') }}" alt="Ayokulakan"
							style="height: 40px;width: 150px;position: relative;bottom: 13px">
						</a>
						<a style="display: block; color: white;" href="https://covid.lpxhbest.com/webui-m-misc/covid-home/index.html?invite_code=K64UG">
							<span> Informasi Covid-19 Disini </span>
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 top-search-holder">
					@if (isset($rental))
						<div class="search-area">
							<form action="{{ route('search-rental') }}">
								<div class="control-group">
									<input type="text" name="search_rental" class="search-field"
									placeholder="Cari Produk..." style="width:84%">
									<button class="search-button"></button>
								</div>
							</form>
						</div>
						@else
						<div class="search-area">
							<form action="{{ url('sc/barang') }}">
								<div class="control-group">
									<input type="text" name="search_ampas" class="search-field"
									placeholder="Cari Produk..." style="width:84%">
									<button class="search-button"></button>
								</div>
							</form>
						</div>
					@endif
				</div>
				<div class="col-xs-4 col-sm-4 col-md-2 animate-dropdown top-cart-row">
					<div class="dropdown dropdown-cart">
						<a href="javascript:void(0)" class="dropdown-toggle lnk-cart show-front shows"
						data-url="{{ url('keranjang/show') }}">
						<div class="items-cart-inner">
							<div class="basket">
								<i class="glyphicon glyphicon-shopping-cart"></i>
							</div>
							<div class="basket-item-count"><span class="count">{{ count($keranjang) }}</span></div>
							<div class="total-price-basket">
								<span class="lbl" style="font-size: 10px;">Keranjang Barang</span>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-2 animate-dropdown top-cart-row">
				<div class="dropdown dropdown-cart">
					<a href="javascript:void(0)" class="dropdown-toggle lnk-cart show-front shows"
					data-url="{{ url('keranjang-sewa/show') }}">
					<div class="items-cart-inner">
						<div class="basket">
							<i class="glyphicon glyphicon-flash"></i>
						</div>
						<div class="basket-item-count"><span class="count">{{ count($sewa) }}</span></div>
						<div class="total-price-basket">
							<span class="lbl" style="font-size: 10px;">Keranjang Sewa</span>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-2 animate-dropdown top-cart-row">
				<div class="dropdown dropdown-cart">
					<a href="javascript:void(0)" class="dropdown-toggle lnk-cart show-front shows"
						data-url="{{ url('favorit/-') }}">
						<div class="items-cart-inner">
							<div class="basket">
								<i class="fa fa-heart"></i>
							</div>
							<div class="basket-item-count"><span class="count">{{ $favorit }}</span></div>
							<div class="total-price-basket">
							<span class="lbl" style="font-size: 10px;">Favorit</span>
							</div>
						</div>
					</a>
				</div>
		</div>
	</div>
	@endif
	</div>
</div>


<div class="header-nav animate-dropdown" style="background:#59b210">
	<div class="">
		<div class="yamm navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
				class="navbar-toggle collapsed" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="nav-bg-class">
			<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
				<div class="nav-outer">
					<ul class="nav navbar-nav" style="margin-left: 35px !important">
						<li>
							<a href="{{ url('/') }}" style="">
								Beranda
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:void(0)" data-hover="dropdown" class="dropdown-toggle"
							data-toggle="dropdown">Sewa <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu container">
								<li>
									<div class="yamm-content " style="max-height: 300px;overflow: scroll;">
										<div class="row">
												@if($kategoriRental1->count() > 0)
												@foreach($kategoriRental1 as $key => $val)
												<div class="col-6 col-xs-6 col-md-3 mb-2" id="togles-kategori">
													<div class="card">
														<div class="card-body text-center">
															<div class="card-text">
																<a href="{{ url('sc/cat-rental/amps/'.slugify($val->nama)) }}"
																	style="padding: 8px 0px">
																	<img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px;height:50px">
																	<p class="title" style="font-size: 11px">{!! $val->nama or '' !!}</p>
																</a>
															</div>
														</div>
													</div>
												</div>
												@endforeach
												@endif
											</div>
										</div>
									</li>
								</ul>
									{{-- <ul class="dropdown-menu pages">
										<li>
											<div class="yamm-content">
												<div class="row">
													<div class="col-xs-12 col-menu"
													style="height: 500px;overflow-x: scroll;">
													<ul class="links">
														@if($kategoriRental1->count() > 0)
														@foreach($kategoriRental1 as $k => $value)
														<li>
															<a
															href="{{ url('sc/cat-rental/amps/'.slugify($value->nama)) }}">{!!
															$value->nama or '' !!}</a>
														</li>
														@endforeach
														@endif
													</ul>
												</div>
											</div>
										</div>
									</li>
								</ul> --}}
							</li>
							{{-- kategori --}}
							<li class="dropdown yamm mega-menu">
								<a href="javascript:void(0)" data-hover="dropdown" class="dropdown-toggle"
								data-toggle="dropdown">Kategori <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu container">
									<li>
										<div class="yamm-content " style="max-height: 300px;overflow: scroll;">
											<div class="row">
												@if($kategoriBarang->count() > 0)
												@foreach($kategoriBarang->get() as $key => $val)
												<div class="col-6 col-xs-6 col-md-3 mb-3" id="togles-kategori">
													<div class="card">
														<div class="card-body text-center">
															<div class="card-text">
																<a href="{{ url('sc/cat-barang/amps/'.slugify($val->kat_nama)) }}"
																	style="padding: 8px 0px">
																	<img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
																	<p class="title" style="font-size: 11px">{{ $val->kat_nama or '' }}</p>
																</a>
															</div>
														</div>
													</div>
												</div>
												@endforeach
												@endif
											</div>
										</div>
									</li>
								</ul>
							</li>
									{{-- sub kategori --}}
							<li class="dropdown yamm mega-menu">
								<a href="javascript:void(0)" data-hover="dropdown" class="dropdown-toggle"
								data-toggle="dropdown">Sub Kategori <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu container">
									<li>
										<div class="yamm-content " style="max-height: 300px;overflow: scroll;">
											<div class="row">
												@if(isset($subkategori))
												@foreach($subkategori as $key => $val)
												<div class="col-6 col-xs-6 col-md-2 mb-3" id="togles-kategori">
													<div class="card">
														<div class="card-body text-center">
															<div class="card-text">
																<a href="{{ url('sc/cat-barang/mps/'.slugify($val->sub_nama)) }}"
																	style="padding: 8px 0px">
																	<img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
																	<p class="title" style="font-size: 11px">{{ $val->sub_nama }}</p>
																</a>
															</div>
														</div>
													</div>
												</div>
												@endforeach
												@endif
											</div>
										</div>
									</li>
								</ul>
							</li>
							@if(isset($mainMenuFrontEnd))
							@foreach($mainMenuFrontEnd->roots() as $key => $value)
							@if($value->hasChildren())
							<li class="dropdown">
								<a href="{!! $value->url() !!}" data-hover="dropdown" class="dropdown-toggle"
									data-toggle="dropdown"
									style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
									tabindex="{{ $value->id }}">
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
															<a href="{{$child->url()}}"
																style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!!
																$child->title !!}</a>
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
								<li class="">
									<a href="{!! $value->url() !!}"
										style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
										tabindex="{{ $value->id }}">
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
