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
                        <img src="{{$movie->cover_image}}" class="card-img-top" alt="...">
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
