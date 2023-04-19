@extends('User/layouts/app')
@section('content')
    <div class="container">
        <div class="text-white text-center p-5" >
            <a class="nav-link active" href="{{route('movieDetail',$movie->id)}}" ><h1 class="display-4">{{$movie->name}} </h1></a>
            <div class="form-group embed-responsive embed-responsive-21by9 bg-light border rounded-3 mt-3 row" style="background-color: #181F3B">
                <video controls="" class="embed-responsive-item border-0" autoplay="false"  name="media" style="background-color: #181F3B"><source src="{{$movie->server_link}}" type="video/mp4"></video>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row text-white text-center">
            <h2 >Related Movies</h2>
            <div  id="movies-slider" class="owl-carousel">
                @foreach(\App\Http\Controllers\MovieController::getMoviesByCategory($movie->categories[0]->id) as $moviee)
                    <div class= "me-3 post-slide" style="width: 250px">
                        <div class="card mb-3 " style="background-color: #181F3B">
                            <img src="{{$moviee->poster_image}}" height="320PX" class="card-img-top post-img" alt="...">
                            <div class="card-body">
                                <a class="nav-link active" href="{{route('movieDetail',$moviee->id)}}" title="{{$moviee->name}}">{{substr($moviee->name,0,15)}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div  id="movies-slider2" class="owl-carousel">
                @foreach(\App\Http\Controllers\MovieController::getMoviesByCategory($movie->categories[1]->id) as $moviee)
                    <div class= "me-3 post-slide" style="width: 250px">
                        <div class="card mb-3 " style="background-color: #181F3B">
                            <img src="{{$moviee->poster_image}}" height="320PX" class="card-img-top post-img" alt="...">
                            <div class="card-body">
                                <a class="nav-link active" href="{{route('movieDetail',$moviee->id)}}" title="{{$moviee->name}}">{{substr($moviee->name,0,15)}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection('content')
@section('scripts')
    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script>
        $(document).ready(function () {
            $("#movies-slider").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });
            $("#movies-slider2").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });

        });
    </script>
@endsection('scripts')
