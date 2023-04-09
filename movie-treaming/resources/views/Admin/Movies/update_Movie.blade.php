@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow " >
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Add new Movie</p>
        </div>
        <div class="card-body">
            <div class="row">
                <form class=" ">
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="name">Movie Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter movie name">
                        </div>

                        <div class="col-sm-6">
                            <label for="serverLink">Server Link</label>
                            <input type="text" class="form-control" id="server_link" placeholder="Enter server link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-4">
                            <label for="poster_image">Poster Image Link</label>
                            <input type="text" class="form-control" id="poster_image" placeholder="Enter poster image link">
                        </div>

                        <div class="col-sm-4">
                            <label for="cover_image">Cover Image Link</label>
                            <input type="text" class="form-control" id="cover_image" placeholder="Enter poster image link">
                        </div>

                        <div class="col-sm-4">
                            <label for="trailerLink">Trailer Video Link</label>
                            <input type="text" class="form-control" id="trailer_video" placeholder="Enter trailer video link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="releaseDate">Released Date</label>
                            <input type="text" class="form-control" id="realased_date" placeholder="Enter release date (yyyy-mm-dd)">
                        </div>

                        <div class="col-sm-6">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" placeholder="Enter duration">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 mt-3 p-3 row">
                        <div class="col-sm-6">
                            <label for="director">Director</label>
                            <select class="directorId form-control" name="states[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\ActorController::getDirectors() as $director)
                                    <option value="{{$director->id}}">{{$director->full_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-sm-6">
                            <label for="languages">Language</label>
                            <select class="form-control" id="languages">
                                <option value="english">English</option>
                                <option value="spanish">Spanish</option>
                                <option value="french">French</option>
                            </select>

                        </div>


                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>



                    <div class="form-group mt-3 bg-light border rounded-3 p-3 mt-3 row">

                        <div class="col-sm-6">
                            <label for="director">Categories</label>
                            <select class="categoryId form-control" name="states[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\categoryController::getCategories() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-sm-6">
                            <label for="director">Actors</label>
                            <select class="actorId form-control" name="states[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\ActorController::getActors() as $actor)
                                    <option value="{{$actor->id}}">{{$actor->full_name}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>



                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" onclick="printselected()" class="btn btn-primary ">Submit</button>

                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection
