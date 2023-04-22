@extends('User/layouts/app')
@section('content')
    <div class="container" >
        <div class=" p-5"  >
            @if(session('msg-error'))
                <div class="alert alert-danger mb-3">
                    {{ session('msg-error') }}
                </div>
            @endif
            @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif
        <div class="row text-white" >

            <div class="card-body">
                <div class="row mt-5 ">
                    <h2 class="text-center">Your Information</h2>
                    <form action="{{route('user-save-profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group   rounded-3 p-3 mt-3 row" style="background-color: #181F3B">
                            <div class="col-md-3 col-sm-12 d-flex justify-content-center">
                                <img src="{{ $user->image }}" class="" alt="user image" height="200px" width="250px">
                            </div>

                            <div class="col-md-9 col-sm-12">
                                <div class="mb-3">
                                    <label for="actor_image" class="form-label">your Image</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                    @if($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="form-group     rounded-3 p-3 mt-3 row">
                                    <div class="col-sm-6">
                                        <label for="full_name">your full Name</label>
                                        <input type="text" class="form-control " value="{{ $user->name }}" id="name" name="name">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="full_name">your Email</label>
                                        <input type="email" class="form-control " value="{{ $user->email }}" id="email" name="email" >
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group     rounded-3 p-3 mt-3 row">
                                    <div class="col-sm-6">
                                        <label for="full_name">old password</label>
                                        <input type="password" class="form-control"  id="old_password" name="old_password">
                                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="full_name">new password</label>
                                        <input type="password" class="form-control"  id="password" name="password">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit"  class="btn btn-primary me-3">Update my information</button>
                                <form action="" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">delete my account</button>
                                </form>
                            </div>
                        </div>



                    </form>
                </div>

            </div>
        </div>
    </div>

            <div class="row text-white text-center">
                <h2 >Rated By you</h2>
                <div  id="movies-slider" class="owl-carousel">
                    @foreach(\App\Http\Controllers\RatingController::getRatedMoviesByUser() as $moviee)
                        <div class= "me-3 post-slide" style="width: 250px">
                            <div class="card mb-3 " style="background-color: #181F3B">
                                <img src="{{$moviee->poster_image}}" height="320PX" class="card-img-top post-img" alt="...">
                                <div class="card-body">
                                    <a class="nav-link active" href="{{route('movieDetail',$moviee->id)}}" title="{{$moviee->name}}">{{substr($moviee->name,0,15)}}</a>
                                    <div class=" d-flex  align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= \App\Http\Controllers\RatingController::getOldReview($moviee->id))
                                                <i class="bi bi-star-fill" style=" color: gold" data-value="{{ $i }}"></i>
                                            @else
                                                <i class="bi bi-star-fill"  data-value="{{ $i }}"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
             <div class="row text-white text-center">
            <h2 >your favorite</h2>
            <div  id="fav-slider" class="owl-carousel">
                @foreach(\App\Http\Controllers\FavoriteController::getFavMovies() as $moviee)
                    <div class= "me-3 post-slide" style="width: 250px">
                        <div class="card mb-3 " style="background-color: #181F3B">
                            <img src="{{$moviee->poster_image}}" height="320PX" class="card-img-top post-img" alt="...">
                            <div class="card-body">
                                <a class="nav-link active" href="{{route('movieDetail',$moviee->id)}}" title="{{$moviee->name}}">{{substr($moviee->name,0,15)}}</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
 @endsection('content')
@section('scripts')
     <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script>


        $(document).ready(function () {

            $("#movies-slider").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });
            $("#fav-slider").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 3],
                itemsMobile: [600, 2],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true });

        });
    </script>
@endsection('scripts')
