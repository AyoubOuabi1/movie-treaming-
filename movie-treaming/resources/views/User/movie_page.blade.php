@php use App\Http\Controllers\FavoriteController; @endphp
@php use App\Http\Controllers\RatingController; @endphp
@extends('User/layouts/app')
@section('content')
    <div class="container-fluid ">
        <div class="p-5 movie-container">
            <div class="text-white ">

                <div class="text-center">
                    <img src="{{$movie->poster_image}}" width="350px" height="400px" alt="movie cover">

                </div>
                <div class="">
                    <h1>{{$movie->name}}</h1>
                    <h3><span>Year : </span> {{$movie->realased_date}}</h3>
                    <div class="row gap-3">

                        @foreach($movie->categories as $category)
                            <span class="border rounded-3  text-center col-lg-2  col-md-3 col-sm-3 ">
                                {{$category->name}}
                            </span>
                        @endforeach


                    </div>
                    <div class="d-flex gap-3">
                        <Bututon type="button" class="btn btn-primary mt-3">Watch Now</Bututon>
                        {{--
                                        @if (Auth::check())
                        --}}

                        <div id="btnConatiner">
                            @if(FavoriteController::checkMovie($movie->id))
                                <button href="#" class="btn btn-danger  mt-3" onclick="removeFromFav({{$movie->id}})"
                                        id="removeFromFav">Remove From favorite
                                </Button>
                            @else
                                <button href="#" class="btn btn-success  mt-3" onclick="addToFav({{$movie->id}})"
                                        id="addToFavBtn">Add to favorite
                                </Button>
                            @endif
                        </div>

                        {{--
                                        @endif
                        --}}
                    </div>
                    <div class="row ">
                        <div class="col-lg-9 col-md-12 ">
                            <h3>Description </h3>
                            <p>{{$movie->description}}</p>
                        </div>

                        <div class=" col-lg-3 col-md-12 ">
                            <h3 class="text-center">Actors</h3>

                            <div class="row text-center gap-2 d-flex justify-content-center">
                                @foreach($movie->actors as $actor)
                                    <div class="col-5">
                                        <img class="rounded-circle"
                                             src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                             alt="user image" height="80px" width="80px"/>
                                        <div>
                                            <a href="http://localhost:8000/actor/{{$actor->id}}">{{$actor->full_name}}</a>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <i class="bi bi-star-fill h1" style="color: #f5c518">&ensp;</i>
                        <div>
                            <h4 class="h4"> {{RatingController::getRatingWithAvg($movie->id)[0]}}
                                / 5</h4>
                            <h4 class="h4"> {{RatingController::getRatingWithAvg($movie->id)[2]}} users</h4>

                        </div>
                    </div>
                    <div class="py-2 px-4" style="box-shadow: 0 0 10px 0 #ddd;">
                        <p class="font-weight-bold ">Review</p>
                        @if(RatingController::checkRate($movie->id))
                            <p class="font-weight-bold ">your old Review
                                is {{RatingController::getRatingWithAvg($movie->id)[1]}}</p>
                        @endif
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
                            @if((RatingController::checkRate($movie->id)))
                                <button class="btn btn-sm py-2 px-3 btn-info" id="updateRateBtn"
                                        onclick="updateRate({{$movie->id}})" data-id="">
                                    Update my review
                                </button>
                                <button class="btn btn-sm py-2 px-3 btn-danger" id="removeRateBtn"
                                        onclick="deleteRate({{$movie->id}})" data-id="">delete my review
                                </button>

                            @else
                                <button class="btn btn-sm py-2 px-3 btn-info" id="giveRateBtn"
                                        onclick="giveRate({{$movie->id}})" data-id="">
                                    Submit
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="row p-5    rounded-3 mb-auto text-white" style="background-color: #181F3B">
            <h2 class="text-center">Trailer</h2>
            <iframe width="560" height="315" src="{{$movie->trailer_video}}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>

    </div>
@endsection('content')
