@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow " id="updateContainer" >
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">update Movie</p>
        </div>
        <div class="card-body">
            <div class="row">
                <form class=" ">
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="name">Movie Name</label>
                            <input type="text" value="{{$movie->name}}" class="form-control" id="name" placeholder="Enter movie name">
                        </div>

                        <div class="col-sm-6">
                            <label for="serverLink">Server Link</label>
                            <input type="text" class="form-control" value="{{$movie->server_link}}" id="server_link" placeholder="Enter server link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-4">
                            <label for="poster_image">Poster Image Link</label>
                            <input type="text" class="form-control" value="{{$movie->poster_image}}" id="poster_image" placeholder="Enter poster image link">
                        </div>

                        <div class="col-sm-4">
                            <label for="cover_image">Cover Image Link</label>
                            <input type="text" class="form-control" value="{{$movie->cover_image}}" id="cover_image" placeholder="Enter poster image link">
                        </div>

                        <div class="col-sm-4">
                            <label for="trailerLink">Trailer Video Link</label>
                            <input type="text" class="form-control" value="{{$movie->trailer_video}}" id="trailer_video" placeholder="Enter trailer video link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="releaseDate">Released Date</label>
                            <input type="text" class="form-control" value="{{$movie->realased_date}}"  id="realased_date" placeholder="Enter release date (yyyy-mm-dd)">
                        </div>

                        <div class="col-sm-6">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" class="form-control" value="{{$movie->duration}}"  id="duration" placeholder="Enter duration">
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
                        <textarea class="form-control"  id="description" rows="3">{{$movie->description}} </textarea>
                    </div>



                    <div class="form-group mt-3 bg-light border rounded-3 p-3 mt-3 row">

                        <div class="col-sm-6">
                            <label for="director">Categories</label>
                            <select class="categoryId form-control" name="states[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\categoryController::getCategories() as $category)
                                    <option value="{{$category->id}}" {{ in_array($category->id,$movie->categories->pluck('id')->toArray()) ? 'selected':'' }}>{{$category->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-sm-6">
                            <label for="director">Actors</label>
                            <select class="actorId form-control" name="states[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\ActorController::getActors() as $actor)
                                    <option value="{{$actor->id}}" {{ in_array($actor->id,$movie->actors->pluck('id')->toArray()) ? 'selected':'' }}>{{$actor->full_name}}</option>

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
@section('scripts')
    <script>
        findMoviee()
    </script>
@endsection('scripts')
