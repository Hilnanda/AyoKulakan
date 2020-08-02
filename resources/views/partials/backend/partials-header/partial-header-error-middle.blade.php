 <!-- Top bar area end -->
 <!-- Header middle area start -->
 <div class="header-middle-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-md-12">
                <!-- site-logo -->
                <div class="site-logo">
                    <a href="{{url('/')}}"><img src="{{ asset('img/logo/ayokulakan-logo-200px.png') }}" alt="Ayokulakan"></a>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <!-- header-search -->
                <div class="header-search clearfix">
                    <div class="header-search-form">
                        <form action="{{ url('sc/barang') }}">
                            <input type="text" name="search_ampas" placeholder="Search product...">
                            <input type="submit" name="submit" value="Search">
                        </form>                                     
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12" style="text-align: center;">
                <!-- shop-cart-menu -->
               <div class="shop-cart-menu">
                    <ul>
                        @if(Auth::check())
                        <li><a href="javascript:void(0)" class="show-front shows" data-url="{{ url('keranjang/show') }}">
                            <span class="cart-icon">
                                <i class="ion-bag"></i><sup>{{ count($keranjang) }}</sup>
                            </span>
                            <span class="cart-text">
                                <span class="cart-text-title">Keranjang <br> <strong>Belanja</strong> </span>
                            </span>
                            </a>
                        </li>
                        <li><a href="javascript:void(0)"><i class="ion-ios-person"></i>&nbsp;
                            <span class="cart-text">
                                <span class="cart-text-title">Selamat Datang <br> <strong>{{ auth()->user()->username  }}</strong> </span>
                            </span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ url('/myprofile') }}">My Profile</a></li>
                                <li><a href="{{ url('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @else
                            <li><a href="{{ url('login') }}"><i class="ion-log-in"></i>
                                <span class="cart-text">
                                    <span class="cart-text-title">Selamat Datang <br> <strong>Silahkan Login</strong> </span>
                                </span>
                                </a>
                            </li>
                            <li><a href="{{ url('register') }}"><i class="ion-person-add"></i>
                                <span class="cart-text">
                                    <span class="cart-text-title">Selamat Datang <br> <strong>Silahkan Register</strong> </span>
                                </span>
                                </a>
                            </li>
                        @endif
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Header middle area end -->
                <!-- Header bottom area start -->