@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="row h-100 p-5 bg-light border rounded-3">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <img src="{{$movie->cover_image}}" alt="movie cover">
                <Bututon type="button" class="btn btn-primary col-8 mt-3" >Watch Now</Bututon>
{{--
                @if (Auth::check())
--}}
                <a href="#" class="btn btn-success col-8 mt-3">Add to favorite</a>
{{--
                @endif
--}}

            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">
                <h1>{{$movie->name}}</h1>
                <h3><span>Year : </span> {{$movie->realased_date}}</h3>
                <h3><span>Categories : </span> @foreach($movie->categories as $category) {{$category->name}} @endforeach</h3>
                <h3>Description </h3>
                <p>{{$movie->description}}</p>
                <div class="d-flex">
                    <i class="bi bi-star-fill h1" style="color: #f5c518">&ensp;</i>
                    <div>
                        <h4 class="h4"> 4.5 / 5</h4>
                        <h4 class="h4"> 56 users</h4>

                    </div>
                </div>
                <div class="py-2 px-4"   style="box-shadow: 0 0 10px 0 #ddd;"  >
                    <p class="font-weight-bold ">Review</p>
                    <div class="form-group row">
                         <div class="col">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate " name="rating" value="5"/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-right">
                        @if(\App\Http\Controllers\RatingController::checkRate($movie->id))
                            <button class="btn btn-sm py-2 px-3 btn-info" id="giveRateBtn" data-id="{{$movie->id}}" >Update my review</button>
                            <button class="btn btn-sm py-2 px-3 btn-danger" id="giveRateBtn" data-id="{{$movie->id}}" >delete my review</button>

                        @else
                            <button class="btn btn-sm py-2 px-3 btn-info" id="giveRateBtn" data-id="{{$movie->id}}" >Submit
                        </button>
                        @endif
                    </div>
                </div>
                <h3 class="text-center">Actors</h3>

                <div class="row text-center">
                    @foreach($movie->actors as $actor)
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            <a href="http://localhost:8000/actor/{{$actor->id}}" >{{$actor->full_name}}</a>

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
