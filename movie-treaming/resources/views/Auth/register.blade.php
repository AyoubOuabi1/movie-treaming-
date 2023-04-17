@extends('Auth/Layouts/app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Login Form</h2>
                <div class="text-center mb-5 text-dark">Made with bootstrap</div>
                <div class="card my-5">
                    <form method="post" action="{{route('save-register')}}" class="card-body cardbody-color p-lg-5">
                        @csrf
                         <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                 width="200px" alt="profile">
                        </div>
                        <div class="mb-3">
                            <label for="name" id="nameLabel" class="text-danger  d-none">d</label>
                            <input type="text" class="form-control" id="name" name="name" onkeyup="checkFullName()" aria-describedby="emailHelp"
                                   placeholder="Full name">
                        </div>
                        <div class="mb-3">
                            <label for="email1" id="emailLabel" class="text-danger d-none">d</label>
                            <input type="email" class="form-control" id="email" name="email" onkeyup="checkEmail()" aria-describedby="emailHelp"
                                   placeholder="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" id="passwordLabel" class="text-danger d-none">d </label>
                            <input type="password" class="form-control" id="password" name="password" onkeyup="checkPassword()" placeholder="password">
                        </div>
                        <div class="mb-3">
                            <label for="ConfirmPassword" id="ConfirmPasswordLabel" class="text-danger d-none">d </label>

                            <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation" onkeyup="checkConfirmPasswordF()" placeholder="Confirm password">
                        </div>
                        <div class="text-center"><button type="submit" id="registerBtn"  class="btn btn-dark px-5 mb-5 w-100"  >Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="#" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection('content')
