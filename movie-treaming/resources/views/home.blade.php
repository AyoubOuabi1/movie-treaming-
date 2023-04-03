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

        </div>
    </div>
    <nav>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#" id="click1" onclick="loadTopMovies(1)">1</a></li>
            <li class="page-item"><a class="page-link" href="#" id="click2" onclick="loadTopMovies(2)">2</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="loadTopMovies(3)">3</a></li>
        </ul>
    </nav>

    @include('components/footer')
@endsection('content')
