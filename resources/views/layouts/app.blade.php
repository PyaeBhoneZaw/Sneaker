<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top d-block ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" style="height: 50px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item m-2">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item m-2">
                            <a href="{{ route('shoes') }}" class="nav-link">{{ __('Shoes') }}</a>
                        </li>
                        @if (Auth::user() && Auth::user()->role == 'admin')
                            <li class="nav-item dropdown m-2">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Add
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item mb-1" href="{{ route('shoe.create') }}">
                                        {{ __('Add Shoe') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('brand.create') }}">
                                        {{ __('Add Brand') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('model.create') }}">
                                        {{ __('Add Model') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown m-2">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Manage
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item mb-1" href="{{ route('shoes.shoe_dashboard') }}">
                                        {{ __('Manage Shoes') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('brands.brand_dashboard') }}">
                                        {{ __('Manage Brand') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('shoe_models.model_dashboard') }}">
                                        {{ __('Manage Model') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('orders.order_dashboard') }}">
                                        {{ __('Order Report') }}
                                    </a>
                                    <a class="dropdown-item mb-1" href="{{ route('contacts.contact_dashboard') }}">
                                        {{ __('Contact List') }}
                                    </a>
                                </div>
                            </li>
                        @else
                        @endif

                    </ul>

                    {{-- Search Bar --}}

                    <div class="mx-auto w-50">
                        <form class="form-inline" method="GET" action="{{ route('shoes.search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for brand or shoename..."
                                    name="keyword" required>
                                <button class="btn btn-outline-dark" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        @auth
                            @if (auth()->user()->cartItems())
                                <div class="nav-item m-3">
                                    <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none">
                                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                                        @if (auth()->user()->cartItems()->count() > 0)
                                            <span class="badge bg-danger">
                                                {{ auth()->user()->cartItems()->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </div>
                            @else
                                <div class="nav-item m-3">
                                    <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none">
                                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="nav-item m-3">
                                <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none">
                                    <i class="fa-solid fa-cart-shopping fa-lg"></i>
                                </a>
                            </div>
                        @endauth
                        <li class="nav-item m-2">
                            <a href="{{ route('about.index') }}" class="nav-link">{{ __('About') }}</a>
                        </li>




                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item m-2">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown my-auto">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>



        <main class="py-4 min-vh-100">
            @yield('content')
        </main>




        <footer class=" bg-dark text-white text-center text-lg-start">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row">
                    <div class="col-lg-6 col-md-12 text-sm-center text-lg-start">
                        <h3 class="text-uppercase">Sneaker hub</h3>
                    </div>
                    <div class="col-lg-6 col-md-12 text-sm-center text-lg-start text-lg-end mb-5">
                        <h5>Your Style, Your Choice<br>Dive into Sneaker Heaven.
                        </h5>
                    </div>
                </div>

                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h4 class="mb-2">Help</h4>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="{{ route('contacts.create') }}"
                                    class="text-white text-decoration-none">Contact Us</a>
                            </li>

                        </ul>

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h4 class="mb-2">Popular Brands</h4>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class="text-white text-decoration-none">Nike</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white text-decoration-none">Air Jordan</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white text-decoration-none">Adidas</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                        <div class="d-flex flex-column text-lg-end">
                            <div class="ml-auto">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"
                                        class="mx-2">
                                        <style>
                                            svg {
                                                fill: #989ea4
                                            }
                                        </style>
                                        <path
                                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"
                                        class="mx-2">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            svg {
                                                fill: #989ea4
                                            }
                                        </style>
                                        <path
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"
                                        class="mx-2">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            svg {
                                                fill: #989ea4
                                            }
                                        </style>
                                        <path
                                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                    </svg>
                                </div>
                                <p class="text-white mt-4">© 2023 Copyright</p>
                            </div>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

        </footer>

    </div>

</body>

</html>
