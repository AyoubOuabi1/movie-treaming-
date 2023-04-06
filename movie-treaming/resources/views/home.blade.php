@extends('User/layouts/app')
@section('content')
    <div class="container p-3">
        <div class="h-100  p-5  text-white rounded-3 mb-3" id="homeCoverContainer" >
            <div>
                <h1 class="display-4" id="movieTtl"> </h1>
                <p class="lead" id="movieDesc"> </p>
                <hr class="my-4">
                 <a class="btn btn-primary btn-lg" href="#" role="button">Watch now</a>
            </div>

        </div>
        <h2 class="my-4 text-white">Last Movies</h2>
        <div class="row" id="topMovies">

        </div>
    </div>

@endsection('content')
