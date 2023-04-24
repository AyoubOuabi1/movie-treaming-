@extends('Auth/Layouts/app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-white mt-5">Login form </h2>
                 <div class="card my-5">
                    <form method="post" action="{{route('save-login')}}" class="card-body cardbody-color p-lg-5">
                        @csrf
                        <div class="text-center">
                            <img src="https://p.kindpng.com/picc/s/227-2271313_user-icon-white-head-icon-hd-png-download.png" class="img-fluid profile-image-pic p-1 img-thumbnail rounded-circle my-3"
                                 width="200px" alt="profile">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                                   placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="password">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-dark px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="{{route('register')}}" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection('content')
