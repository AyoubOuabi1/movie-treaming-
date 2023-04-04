@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="row h-100 p-5 bg-light border rounded-3">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <img src="{{$movie->cover_image}}" alt="movie cover">
                <Bututon type="button" class="btn btn-primary col-8 mt-3" >Watch Now</Bututon>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">
                <h1>{{$movie->name}}</h1>
                <h3><span>Year : </span> {{$movie['realased_date']}}</h3>
                <h3><span>Categories : </span> @foreach($movie->categories as $category) {{$category->name}} @endforeach</h3>
                <h3>Description </h3>
                <p>{{$movie['description']}}</p>
                <h3 class="text-center">Actors</h3>

                <div class="row text-center">
                    @foreach($movie->actors as $actor)
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            {{$actor->full_name}}
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>
    <div class="row h-100 p-5 bg-light border rounded-3 mb-3">
        <h2 class="text-center">Trailer</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/IrabKK9Bhds" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>

    <div class="row">
        <h2> More Movies</h2>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card mb-3">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">testt ets ets ets te stttttttttttttt</h5>
                    <p class="card-text">ttt bdcsb cwvcuhdcbuysdgcdsuc</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>


    </div>
</div>
    @include('components/footer')
@endsection('content')
