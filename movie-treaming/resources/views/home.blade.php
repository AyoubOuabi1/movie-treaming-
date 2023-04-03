@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="h-100 p-5 bg-light border rounded-3 mt-3">
            <h1 class="display-4">Watch your favorite movies and TV shows</h1>
            <p class="lead">Stream unlimited movies and TV shows on your favorite devices without any ads.</p>
            <hr class="my-4">
            <p>Start your free trial now and enjoy unlimited access to our vast library of movies and TV shows.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Start Your Free Trial</a>
        </div>
        <h2 class="my-4">Popular Movies</h2>
        <div class="row" id="topMovies">
            <div class="col-md-3 col-sm-6">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/300x450.png?text=Movie+Poster" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <p class="card-text">Movie description goes here...</p>
                        <a href="#" class="btn btn-primary">Watch Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/300x450.png?text=Movie+Poster" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <p class="card-text">Movie description goes here...</p>
                        <a href="#" class="btn btn-primary">Watch Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3  col-sm-6">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/300x450.png?text=Movie+Poster" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <p class="card-text">Movie description goes here...</p>
                        <a href="#" class="btn btn-primary">Watch Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3  col-sm-6">
                <div class="card mb-3 ">
                    <img src="https://via.placeholder.com/300x450.png?text=Movie+Poster" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <p class="card-text">Movie description goes here...</p>
                        <a href="#" class="btn btn-primary">Watch Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('components/footer')
@endsection('content')
