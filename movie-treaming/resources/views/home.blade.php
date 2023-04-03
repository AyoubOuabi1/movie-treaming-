@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="my-4">Popular Movies</h2>
        <div class="row">
            @foreach($pagedMovies as $movie)
                <div class="col-lg-3 col-md-4  col-6">
                    <div class="card mb-3">
                        <img src="{{ $movie->cover_image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->name }}</h5>
                            <p class="card-text">{{ substr($movie->description, 0, 70) }}...</p>
                            <a href="#" class="btn btn-primary">Watch Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $pagedMovies->links() }}
        </div>
    </div>
@endsection

