@extends('User/layouts/app')
@section('content')
    <div class="p-5 text-white rounded-3 mb-3" style="background: url('{{$movie->cover_image}}');background-size:100% 100%; background-repeat : no-repeat " >
        <div class="container mt-5">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
                    <div class="d-flex justify-content-center">
                        <img src="{{$movie->poster_image}}" class="img-fluid rounded"  />

                    </div>
                    <div class="d-flex align-items-center flex-column">
                        <a class="btn btn-primary col-8 mt-3  mt-3" href="{{route('watchMovie',$movie->id)}}" role="button">Watch now</a>

                    @if(\App\Http\Controllers\FavoriteController::checkMovie($movie->id))
                            <button href="#" class="btn btn-danger col-8 mt-3" data-id="{{$movie->id}}" id="removeFromFav">Remove From  favorite</Button>
                        @else
                            <button href="#" class="btn btn-success col-8 mt-3" data-id="{{$movie->id}}" id="addToFavBtn">Add to favorite</Button>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <h1 class="display-4">{{$movie->name}} </h1>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-calendar2-minus me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="yearr" class="mt-2" style="font-size: 25px">{{$movie->realased_date}}</strong>
                    </h4>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-clock-history me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="duration" class="mt-2" style="font-size: 25px">{{$movie->duration}} min</strong>
                    </h4>
                    <div class="d-flex flex-row gap-3">
                        @foreach($movie->categories as $category)
                            <h6 class="rounded p-1" style="border: gold 1px solid">  {{$category->name}}</h6>

                        @endforeach
                    </div>
                    <p class="lead" >{{$movie->description}}</p>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-star-fill me-3" style="font-size: 25px;color: gold"></i>
                        <strong  class="mt-2" style="font-size: 25px">{{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[0]}}  ({{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[2]}} users)</strong>
                    </h4>
                    <hr class="my-4">

                    <h4 class="mt-3">Directed By</h4>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle"

                             src="{{\App\Http\Controllers\ActorController::findDirector($movie->directorId)->actor_image}}"
                             alt="user image" height="90px" width="90px"/>
                        <div>
                            <a class="nav-link active" href="{{route('showActor',\App\Http\Controllers\ActorController::findDirector($movie->directorId)->id)}}">{{\App\Http\Controllers\ActorController::findDirector($movie->directorId)->full_name}}</a>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-white text-center">
            <h2 >Actors</h2>
            <div  id="actors-slider" class="owl-carousel ">
                @foreach($movie->actors as $actor)
                    <div class= "me-3 post-slide" style="width: 250px">
                        <div class="card mb-3 " style="background-color: #181F3B">
                            <img src="{{$actor->actor_image}}" height="320PX" class="card-img-top post-img" alt="...">
                            <div class="card-body">
                                <a class="nav-link active" href="{{route('showActor',$actor->id)}}" title="{{$actor->full_name}}">{{substr($actor->full_name,0,20)}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="row text-white text-center p-5">
            <h2 >Trailer</h2>
            <iframe width="560" height="315" src="{{$movie->trailer_video}}" class="rounded"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>

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

        </div>
    </div>
@endsection('content')
@section('scripts')
    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script>
        $(document).ready(function () {
            $("#actors-slider").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });
            $("#movies-slider").owlCarousel({
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
