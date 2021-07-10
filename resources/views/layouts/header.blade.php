<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Miễn phí ship với hoá đơn 100k
                </div>

                <div class="right-top-bar flex-w h-full">
                    @guest
                        <a href="{{ route('user.login') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng nhập
                        </a>
    
                        <a href="{{ route('user.register') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng kí
                        </a>
                    @else
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                            {{ Auth::user()->name }}
                        </a>
                        
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                            </a>
                            
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('frontend/images/icons/logo.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ Route::is('index') ? 'active-menu' : '' }}">
                            <a href="{{ route('index') }}">Trang chủ</a>
                        </li>

                        <li class="{{ Route::is('product') ? 'active-menu' : '' }}">
                            <a href="{{ route('product') }}">Sản phẩm</a>
                        </li >

                        <li class="{{ Route::is('blog') ? 'active-menu' : '' }}">
                            <a href="{{ route('blog') }}">Tin tức</a>
                        </li>

                        <li class="{{ Route::is('about') ? 'active-menu' : '' }}">
                            <a href="{{ route('about') }}">Giới thiệu</a>
                        </li>

                        <li class="{{ Route::is('contact') ? 'active-menu' : '' }}">
                            <a href="{{ route('contact') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <a href="{{ route('order') }}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="{{ Cart::content()->count() }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>

                    @auth
                        <a href="{{ route('history', ['user_id' => Auth::id()]) }}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <i class="zmdi zmdi-time-restore"></i>
                        </a>
                    @endauth
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="{{ route('index') }}"><img src="{{ asset('frontend/images/icons/logo.png') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{ Cart::count() }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Miễn phí ship chho đơn 100k
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    @guest
                        <a href="{{ route('user.login') }}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
    
                        <a href="{{ route('user.register') }}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    @else
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                            {{ Auth::user()->name }}
                        </a>
                        
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                    @endguest
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li class="{{ Route::is('index') ? 'active-menu' : '' }}">
                <a href="{{ route('index') }}">Home</a>
            </li>

            <li class="{{ Route::is('product') ? 'active-menu' : '' }}">
                <a href="{{ route('product') }}">Shop</a>
            </li >

            <li class="{{ Route::is('blog') ? 'active-menu' : '' }}">
                <a href="{{ route('blog') }}">Blog</a>
            </li>

            <li class="{{ Route::is('about') ? 'active-menu' : '' }}">
                <a href="{{ route('about') }}">About</a>
            </li>

            <li class="{{ Route::is('contact') ? 'active-menu' : '' }}">
                <a href="{{ route('contact') }}">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('frontend/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" action="{{ route('product.search') }}" method="POST">
                @csrf
                <button class="flex-c-m trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Tìm kiếm ....">
            </form>
        </div>
    </div>
</header>