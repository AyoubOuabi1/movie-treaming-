@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="row h-100 p-5 bg-light border rounded-3">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <img src="https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg" alt="movie cover">
                <Bututon type="button" class="btn btn-primary col-8 mt-3" >Watch Now</Bututon>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">
                <h1>this is test title without testt </h1>
                <h3><span>Year : </span> 2018</h3>
                <h3><span>Categories : </span> Drama Action Comedy</h3>
                <h3>Description </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod sapien vel diam consequat consequat. Fusce laoreet pharetra arcu. Pellentesque vel mollis neque, vitae varius turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
                <h3 class="text-center">Actors</h3>

                <div class="row text-center">
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user image" height="90px" width="90px"/>
                        <div>
                            Ayoub Ouabi
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row h-100 p-5 bg-light border rounded-3 mb-3">
        <h2 class="text-center">Trailer</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/IrabKK9Bhds" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    </div>
    @include('components/footer')
@endsection('content')
