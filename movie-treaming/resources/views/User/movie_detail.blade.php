@extends('User/layouts/app')
@section('content')
    <div class="p-5 text-white rounded-3 mb-3" style="background: url('{{$movie->cover_image}}');background-size:100% 100%; background-repeat : no-repeat " >
        <div class="container mt-5">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
                    <div class="d-flex justify-content-center">
                        <img src="{{$movie->poster_image}}" class="img-fluid rounded"  />

                    </div>
                    <div class="d-flex justify-content-center ">
                        @if(\App\Http\Controllers\FavoriteController::checkMovie($movie->id))
                            <button href="#" class="btn btn-danger col-8 mt-3" data-id="{{$movie->id}}" id="removeFromFav">Remove From  favorite</Button>
                        @else
                            <button href="#" class="btn btn-success col-8 mt-3" data-id="{{$movie->id}}" id="addToFavBtn">Add to favorite</Button>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <h1 class="display-4">{{$movie->name}} </h1>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-calendar2-minus me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="yearr" class="mt-2" style="font-size: 25px">{{$movie->realased_date}}</strong>
                    </h4>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-clock-history me-3" style="font-size: 25px;color: gold"></i>
                        <strong id="duration" class="mt-2" style="font-size: 25px">{{$movie->duration}} min</strong>
                    </h4>
                    <div class="d-flex flex-row gap-3">
                        @foreach($movie->categories as $category)
                            <h6 class="rounded p-1" style="border: gold 1px solid">  {{$category->name}}</h6>

                        @endforeach
                    </div>
                    <p class="lead" >{{$movie->description}}</p>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-star-fill me-3" style="font-size: 25px;color: gold"></i>
                        <strong  class="mt-2" style="font-size: 25px">{{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[0]}}  ({{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[2]}} users)</strong>
                    </h4>
                    <hr class="my-4">

                     <a class="btn btn-primary col-sm-6 col-md-4 col-lg-2 btn-lg mt-3" href="#" role="button">Watch now</a>
                    <h4 class="mt-3">Directed By</h4>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle"

                             src="{{\App\Http\Controllers\ActorController::findDirector($movie->directorId)->actor_image}}"
                             alt="user image" height="90px" width="90px"/>
                        <div>
                            <a class="nav-link active" href="{{route('showActor',\App\Http\Controllers\ActorController::findDirector($movie->directorId)->id)}}">{{\App\Http\Controllers\ActorController::findDirector($movie->directorId)->full_name}}</a>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-white text-center">
            <h2 >Actors</h2>
            @foreach($movie->actors as $actor)
                <div class="col-lg-2 col-md-3 col-6" >
                    <div class="card mb-3 " style="background-color: #181F3B">
                        <img src="{{$actor->actor_image}}" height="320PX" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a class="nav-link active" href="{{route('showActor',$actor->id)}}">{{$actor->full_name}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
 {{--   <div class="container">
        <div class="row">
            <div class="row h-100 p-5 card-background  rounded-3 text-white ms-0 mb-3">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <img src="{{$movie->cover_image}}" width="230px" height="330px" alt="movie cover">
                    <Bututon type="button" class="btn btn-primary col-8 mt-3">Watch Now</Bututon>
                    --}}{{--
                                    @if (Auth::check())
                    --}}{{--

                    <div id="btnConatiner">
                        @if(\App\Http\Controllers\FavoriteController::checkMovie($movie->id))
                            <button href="#" class="btn btn-danger col-8 mt-3" data-id="{{$movie->id}}" id="removeFromFav">Remove From  favorite</Button>
                        @else
                            <button href="#" class="btn btn-success col-8 mt-3" data-id="{{$movie->id}}" id="addToFavBtn">Add to favorite</Button>
                        @endif
                    </div>

                    --}}{{--
                                    @endif
                    --}}{{--

                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <h1>{{$movie->name}}</h1>
                    <h3><span>Year : </span> {{$movie->realased_date}}</h3>
                    <h3><span>Categories : </span> @foreach($movie->categories as $category)
                            {{$category->name}}
                        @endforeach</h3>
                    <h3>Description </h3>
                    <p>{{$movie->description}}</p>
                    <div class="d-flex">
                        <i class="bi bi-star-fill h1" style="color: #f5c518">&ensp;</i>
                        <div>
                            <h4 class="h4"> {{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[0]}}
                                / 5</h4>
                            <h4 class="h4"> {{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[2]}} users</h4>

                        </div>
                    </div>
                    <div class="py-2 px-4" style="box-shadow: 0 0 10px 0 #ddd;">
                        <p class="font-weight-bold ">Review</p>
                        @if(\App\Http\Controllers\RatingController::checkRate($movie->id))
                            <p class="font-weight-bold ">your old Review
                                is {{\App\Http\Controllers\RatingController::getRatingWithAvg($movie->id)[1]}}</p>
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
                            @if((\App\Http\Controllers\RatingController::checkRate($movie->id)))
                                <button class="btn btn-sm py-2 px-3 btn-info" id="updateRateBtn" data-id="{{$movie->id}}">
                                    Update my review
                                </button>
                                <button class="btn btn-sm py-2 px-3 btn-danger" id="removeRateBtn"
                                        data-id="{{$movie->id}}">delete my review
                                </button>

                            @else
                                <button class="btn btn-sm py-2 px-3 btn-info" id="giveRateBtn" data-id="{{$movie->id}}">
                                    Submit
                                </button>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-center">Actors</h3>

                    <div class="row text-center">
                        @foreach($movie->actors as $actor)
                            <div class="col-lg-3 col-md-4 col-6">
                                <img class="rounded-circle"
                                     src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                     alt="user image" height="90px" width="90px"/>
                                <div>
                                    <a href="http://localhost:8000/actor/{{$actor->id}}">{{$actor->full_name}}</a>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
        <div class="row h-100 p-5 card-background  rounded-3 mb-3">
            <h2 class="text-center">Trailer</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/IrabKK9Bhds"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>

    </div>--}}
@endsection('content')
@section('scripts')
    <script>

    </script>
@endsection('scripts')
