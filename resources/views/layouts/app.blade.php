<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('style')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboad.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.edit', ['id' => Auth::user()->id]) }}">
                                        {{ __('Profile') }}
                                    </a>

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
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a class="form-control btn btn-primary" href="{{route('orders.index')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp; Order Management</a>
                        <br>
                        <br>
                        <div class="card border-primary">
                            <div class="card-header border-primary">
                                Product Management
                            </div>
            
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{route('dashboad.index')}}">Dashboard</a></li>
                                    <li class="list-group-item"><a href="{{route('productcategories.index')}}">Product categories</a></li>
                                    <li class="list-group-item"><a href="{{route('sizes.index')}}">Sizes</a></li>
                                    <li class="list-group-item"><a href="{{route('colors.index')}}">Color</a></li>
                                    <li class="list-group-item"><a href="{{route('products.index')}}">Products</a></li>
                                    <li class="list-group-item"><a href="{{route('tags.index')}}">Tags</a></li>
                                    <li class="list-group-item"><a href="{{route('commentproducts.index')}}">Product comments</a></li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        
                        <div class="card border-primary">
                            <div class="card-header border-primary">
                                Post Management
                            </div>
            
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{route('postcategories.index')}}">Post categories</a></li>
                                    <li class="list-group-item"><a href="{{route('posts.index')}}">Posts</a></li>
                                    <li class="list-group-item"><a href="{{route('commentposts.index')}}">Post comments</a></li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        
                        <div class="card border-primary">
                            <div class="card-header border-primary">
                                System Management
                            </div>

                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{route('slides.index')}}">Slides</a></li>
                                    <li class="list-group-item"><a href="{{route('abouts.index')}}">About</a></li>
                                    <li class="list-group-item"><a href="{{route('contacts.index')}}">Contact</a></li>
                                    <li class="list-group-item"><a href="{{route('users.index')}}">Users</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>

                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    
    <!-- Scripts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
    </script>
    @yield('script')
</body>
</html>