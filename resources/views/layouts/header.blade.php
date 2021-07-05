@php
    //import the controller
    use App\Http\Controllers\ProductController;
    
    $total = 0;
    $totalOrders = 0;
    
    //if session exists display count counter
    if(Session()->has('customer')){
        $total = ProductController::cartCount();
        $totalOrders = ProductController::orderCount();
    }
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Icofont --}}
    <link rel="stylesheet" href="{{asset('icofont/icofont/icofont.min.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Wishlist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('track_my_orders')}}">Track my Orders <span class="badge badge-info">{{$totalOrders}}</span></a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (session()->has('customer'))
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ session('customer')->name}}
                    </a>
                    
                   
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
                        
                       
                        <a class="dropdown-item" href="{{ route('logout_customer') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout_customer') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('get_cart_items')}}">Cart <span class="badge badge-success">{{$total}}</span></a>
                </li>

                @else

                    @if (Route::has('login_customers'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login_customers') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
            
                    @if (Route::has('register_customers'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register_customers') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                        
                 @endif
                   
                @else
               
                   
                    
                @endguest
            </ul>
        </div>
    </div>
</nav>
</body>