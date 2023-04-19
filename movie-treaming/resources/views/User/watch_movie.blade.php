@extends('User/layouts/app')
@section('content')
    <div class="h-100 text-white text-center p-5">
        <h1 class="display-4">{{$movie->name}} </h1>
        <div class="form-group bg-light border rounded-3 p-3 mt-3 row" >
            <video controls="" autoplay="false"  name="media"><source src="{{$movie->server_link}}" type="video/mp4"></video>
        </div>
    </div>
@endsection('content')
