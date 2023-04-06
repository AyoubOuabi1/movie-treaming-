@extends('User/layouts/app')
@section('content')
    <div class="container p-3">
        <div class="h-100 p-5  text-white rounded-3 mb-3" style="background-color: #181F3B;">
            <h1 class="display-4">Watch your favorite movies and TV shows</h1>
            <p class="lead">Stream unlimited movies and TV shows on your favorite devices without any ads.</p>
            <hr class="my-4">
            <p>Start your free trial now and enjoy unlimited access to our vast library of movies and TV shows.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Start Your Free Trial</a>
        </div>
        <h2 class="my-4 text-white">Last Movies</h2>
        <div class="row" id="topMovies">

        </div>
    </div>

@endsection('content')
