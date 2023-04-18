@extends('User/layouts/app')
@section('content')
    <div class="">
        <div class="p-5 text-white rounded-3 mb-3" id="homeCoverContainer" >
            <div class="container mt-5">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <img src="" class="img-fluid" id="poster_slider" />
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                        <h1 class="display-4" id="movieTtl"></h1>
                        <h4 class="d-flex align-items-center">
                            <i class="bi bi-calendar2-minus me-3" style="font-size: 25px;color: gold"></i>
                            <strong id="yearr" class="mt-2" style="font-size: 25px"></strong>
                        </h4>
                        <h4 class="d-flex align-items-center">
                            <i class="bi bi-clock-history me-3" style="font-size: 25px;color: gold"></i>
                            <strong id="duration" class="mt-2" style="font-size: 25px"></strong>
                        </h4>
                        <div class="d-flex gap-3" id="categories"></div>
                        <p class="lead" id="movieDesc"></p>
                        <hr class="my-4">
                        <a class="btn btn-primary col-sm-6 col-md-4 col-lg-2 btn-lg mt-auto" href="#" role="button">Watch now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h2 class="my-4 text-white">Last Movies</h2>
            <div class="row" id="topMovies"></div>


        </div>
    </div>

@endsection('content')
