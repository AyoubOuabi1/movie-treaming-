
@extends('User/layouts/app')
@section('content')
    <div class="p-5 text-white rounded-3 mb-3" style="background-color: #181F3B">
        <div class="container mt-5">
            <div class="row" >
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
                    <div class="d-flex justify-content-center">
                        <img src="{{$actor->actor_image}}" class="img-fluid rounded"  />

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <h1 class="display-4">{{$actor->full_name}} </h1>

                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-calendar2-minus me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="yearr" class="mt-2" style="font-size: 25px">{{$actor->born_in}}</strong>
                    </h4>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-globe me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="duration" class="mt-2" style="font-size: 25px">{{$actor->nationality}} </strong>
                    </h4>

                    <p class="lead" >{!! $actor->description !!} </p>



                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row text-white text-center">
            <h2>Movies By Actor</h2>
            <div  id="movies-slider" class="owl-carousel">
                @foreach($movies as $moviee)
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
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


{{--
@extends('User/layouts/app')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="row h-100 p-5 bg-light border rounded-3">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <img
                        src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg"
                        height="400px" class="card-img-top col-10" alt="...">

                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <h1>{{$actor->full_name}}</h1>
                    <h3><span>Born in  : </span> {{$actor->born_in}}</h3>
                    <h3><span>Nationality : </span> {{$actor->nationality}} </h3>
                    <p><span class="h3">Description : </span> {{$actor->description}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Movies By Actor</h2>
            @foreach($movies as $movie)
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="card mb-3">
                        <img src="{{$movie->poster_image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$movie->name}}</h5>
                            <p class="card-text">{{Str::substr($movie->description, 10)}}...</p>
                            <a href="http://localhost:8000/movie/{{$movie->id}}" class="btn btn-primary">Watch Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    @include('components.footer')

@endsection('content')
--}}
