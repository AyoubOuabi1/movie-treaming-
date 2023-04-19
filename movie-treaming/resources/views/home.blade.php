@extends('User/layouts/app')
@section('content')
    @php
        $topMovie = \App\Http\Controllers\MovieController::getTopMovies();

    @endphp
    <div class="">
        <div id="top-slider">
            @for ($i = 0; $i < 5; $i++)
                <div class="p-5 text-white rounded-3 mb-3" id="homeCoverContainer" style="background: url('{{$topMovie[$i]->cover_image}}');background-size:100% 100%; background-repeat : no-repeat ">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                <img src="{{$topMovie[$i]->poster_image}}" class="img-fluid" id="poster_slider" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                <h1 class="display-4">{{$topMovie[$i]->name}} </h1>
                                <h4 class="d-flex align-items-center">
                                    <i class="bi bi-calendar2-minus me-3" style="font-size: 25px;color: gold"></i>
                                    <strong id="yearr" class="mt-2" style="font-size: 25px">{{$topMovie[$i]->realased_date}}</strong>
                                </h4>
                                <h4 class="d-flex align-items-center">
                                    <i class="bi bi-clock-history me-3" style="font-size: 25px;color: gold"></i>
                                    <strong id="duration" class="mt-2" style="font-size: 25px">{{$topMovie[$i]->duration}} min</strong>
                                </h4>
                                <div class="d-flex flex-row gap-3">
                                    @foreach($topMovie[$i]->categories as $category)
                                        <h6 class="rounded p-1" style="border: gold 1px solid">  {{$category->name}}</h6>

                                    @endforeach
                                </div>
                                <p class="lead" >{{substr($topMovie[$i]->description,0,70) }}</p>
                                <h4 class="d-flex align-items-center">
                                    <i class="bi bi-star-fill me-3" style="font-size: 25px;color: gold"></i>
                                    <strong  class="mt-2" style="font-size: 25px">{{\App\Http\Controllers\RatingController::getRatingWithAvg($topMovie[$i]->id)[0]}}  ({{\App\Http\Controllers\RatingController::getRatingWithAvg($topMovie[$i]->id)[2]}} users)</strong>
                                </h4>
                                <hr class="my-4">
                                <a class="btn btn-primary col-sm-6 col-md-4 col-lg-2 btn-lg mt-auto" href="{{route('movieDetail',$topMovie[$i]->id)}}" role="button">Watch now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>

        <div class="container">
            <div class="row text-white text-center">
                <h2>Top 15 Movies</h2>
                <div  id="movies-slider" class="owl-carousel">
                    @foreach($topMovie as $moviee)
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
                <h2>Drama Movies</h2>
                <div  id="movies-slider2" class="owl-carousel">
                    @foreach(\App\Http\Controllers\MovieController::getMoviesByCategory('drama') as $moviee)
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
                <h2>Action Movies</h2>
                <div  id="movies-slider3" class="owl-carousel">
                    @foreach(\App\Http\Controllers\MovieController::getMoviesByCategory('action') as $moviee)
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
                <h2>Top Actors</h2>
                <div  id="actors-slider" class="owl-carousel">
                    @foreach(\App\Http\Controllers\MovieController::getTopActors() as $actor)
                        <div class= "me-3 post-slide" style="width: 250px">
                            <div class="card mb-3 " style="background-color: #181F3B">
                                <img src="{{$actor->actor_image}}" height="320PX" class="card-img-top post-img" alt="...">
                                <div class="card-body">
                                    <a class="nav-link active" href="{{route('showActor',$actor->id)}}" title="{{$actor->full_name}}">{{substr($actor->full_name,0,15)}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection('content')

@section('scripts')
    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script>
        $(document).ready(function () {
            var carouselConfig = {
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true
            };

            $("#actors-slider").owlCarousel(carouselConfig);
            $("#movies-slider").owlCarousel(carouselConfig);
            $("#movies-slider2").owlCarousel(carouselConfig);
            $("#movies-slider3").owlCarousel(carouselConfig);
            $("#top-slider").owlCarousel({
                items: 1,
                itemsDesktop: [1199, 1],
                itemsDesktopSmall: [980, 1],
                itemsMobile: [600, 1],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });

        });
    </script>
@endsection('scripts')
