@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Embed Video from YouTube -->
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Qh7wFeHwKVw" allowfullscreen></iframe>
            </div>
            <!-- Video Description and Actors -->
            <div class="my-4">
                <h2>Movie Title</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod sapien vel diam consequat consequat. Fusce laoreet pharetra arcu. Pellentesque vel mollis neque, vitae varius turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
                <h4>Actors:</h4>
                <ul>
                    <li>Actor 1</li>
                    <li>Actor 2</li>
                    <li>Actor 3</li>
                </ul>
            </div>
            <!-- Trailer from YouTube -->
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Qh7wFeHwKVw" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Video Stream -->
            <div class="embed-responsive embed-responsive-16by9">
                <video controls>
                    <iframe src="https://viidshar.com/embed-fsycbrbdid5r.html" style="position: absolute; width: 1px; height: 1px; display: none; opacity: 0;"></iframe>
                </video>
            </div>
        </div>
    </div>
</div>
@endsection('content')
