@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="h-100 p-5 bg-light border rounded-3 mt-3">
            <h1 class="display-4">My favorite movies </h1>
        </div>
        <h2 class="my-4">Popular Movies</h2>
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="card mb-3">
                        <img src="{{$movie->cover_image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$movie->name}}</h5>
                            <p class="card-text">{{Str::substr($movie->description, 30)}}...</p>
                            <a href="http://localhost:8000/movie/{{$movie->id}}" class="btn btn-primary">Watch Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    @include('components/footer')
@endsection('content')
