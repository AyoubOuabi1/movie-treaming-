<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>

     <link rel="stylesheet" href="{{ URL::asset('style/style.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{--
        <link href="{!! asset('theme/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body class="page-top" >
<div class="container-fluid">
    <nav class="navbar  w-100  navbar-expand-lg navbar-dark bg-transparent text-white  position-fixed" style="z-index: 2;margin-left: -12px">
        <div class="container pl-2">
            <a class="navbar-brand pl-2" href="#">Drama House</a>
            <button class="navbar-toggler mr-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-around g-2"   id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home-page')}}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/favorites">My Favorite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('get-rated')}}">My Ratings</a>
                    </li>

                </ul>
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item me-lg-3 text-black">
                        <div class="nav-item dropdown no-arrow" role="search">
                            <input class="form-control me-2 mb-md-2 dropdown-toggle nav-link text-black" type="search" id="searchInput"   aria-expanded="false" data-bs-toggle="dropdown" placeholder="Search" aria-label="Search">
                            <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                <h6 class="dropdown-header">result</h6>
                                <div id="searchReuslt">

                                </div>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">

                        @if(\App\Http\Middleware\JwtMiddleware::checkLogin())
                            <button type="button" class="btn btn-primary ">logOut</button>
                        @else
                            <a type="button" href="{{route('login')}}" class="btn btn-primary ">Login</a>
                        @endif

                    </li>


                </ul>


            </div>
        </div>
    </nav>

</div>
<div style="background-color: #0b122e" style="z-index: 1">
    @yield('content')
</div>

@routes

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
@include('components/toaster')

@yield('scripts')
</body>
</html>
