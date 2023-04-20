@extends('User/layouts/app')
@section('content')
    <div class="container" >

        <div class="  p-5  "  >
        <div class="row text-white" >
            <h2 class="text-center  mt-5">My Rated Movies</h2>
            @foreach($movies as $movie)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="card mb-3 " style="background-color: #181F3B">
                            <img src="{{$movie->poster_image}}" height="320PX" class="card-img-top post-img" alt="...">
                            <div class="card-body">
                                <a class="nav-link active" href="{{route('movieDetail',$movie->id)}}" title="{{$movie->name}}">{{substr($movie->name,0,15)}}</a>
                                <div class="">
                                    <div class=" d-flex  align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= \App\Http\Controllers\RatingController::getOldReview($movie->id))
                                                <i class="bi bi-star-fill" style=" color: gold" data-value="{{ $i }}"></i>
                                            @else
                                                <i class="bi bi-star-fill"  data-value="{{ $i }}"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             @endforeach
        </div>
    </div>

            <div class="row text-white text-center">
                <h2 >Recommended to you</h2>
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
