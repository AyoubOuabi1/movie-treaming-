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
                            <select class="form-control" id="directorId">
                                <option selected disabled>Select Director</option>
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
                            <div class="d-flex justify-content-around">
                                <label for="actors col-md-6 col-sm-12">Categories</label>
                                <div class="col-md-6 col-sm-12">
                                     <input type="text" class="form-control "  id="categorySearch" onkeyup="getCategoriesForMovies()" placeholder="Enter actor name">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody id="cat_body_M">
                                    @foreach(\App\Http\Controllers\categoryController::getCategories() as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                <input value="{{$category->id}}" type="checkbox" id="category_{{$category->id}}" class="categoryIds" name="categoryIds">
                                            </td>
                                        </tr>
                                    @endforeach()

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-around">
                                <label for="actors col-md-6 col-sm-12">Actors</label>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" class="form-control" id="actorSearch" onkeyup="getActorsForMovies()" placeholder="Enter actor name">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody id="actors_body_M">
                                    @foreach(\App\Http\Controllers\ActorController::getActors() as $actor)
                                        <tr>
                                            <td>{{$actor->full_name}}</td>
                                            <td>
                                                <input value="{{$actor->id}}" type="checkbox" id="actor_{{$actor->id}}" name="actorsIds" class="actorsIds">
                                            </td>
                                        </tr>
                                    @endforeach()
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" onclick="insertMovie()" class="btn btn-primary ">Submit</button>

                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection
