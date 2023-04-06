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
                            <label for="movieName">Movie Name</label>
                            <input type="text" class="form-control" id="movieName" placeholder="Enter movie name">
                        </div>

                        <div class="col-sm-6">
                            <label for="serverLink">Server Link</label>
                            <input type="text" class="form-control" id="serverLink" placeholder="Enter server link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="imageLink">Image Link</label>
                            <input type="text" class="form-control" id="imageLink" placeholder="Enter image link">
                        </div>

                        <div class="col-sm-6">
                            <label for="trailerLink">Trailer Video Link</label>
                            <input type="text" class="form-control" id="trailerLink" placeholder="Enter trailer video link">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="releaseDate">Released Date</label>
                            <input type="text" class="form-control" id="releaseDate" placeholder="Enter release date (yyyy-mm-dd)">
                        </div>

                        <div class="col-sm-6">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" placeholder="Enter duration">
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 mt-3 p-3 row">
                        <div class="col-sm-6">
                            <label for="director">Director</label>
                            <select class="form-control" id="director">
                                <option value="director1">Director 1</option>
                                <option value="director2">Director 2</option>
                                <option value="director3">Director 3</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="language">Language</label>
                            <select class="form-control" id="language">
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
                                    <input type="text" class="form-control" id="actorSearch" placeholder="Enter actor name">
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
                                    <tbody class="cat_body_M">
                                    @foreach(\App\Http\Controllers\categoryController::getCategories() as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                <input value="{{$category->id}}" type="checkbox" id="actor1" name="actor1">
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
                                    <input type="text" class="form-control" id="actorSearch" placeholder="Enter actor name">
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
                                    <tbody class="actors_body_M">
                                    @foreach(\App\Http\Controllers\ActorController::getActors() as $actor)
                                        <tr>
                                            <td>{{$actor->full_name}}</td>
                                            <td>
                                                <input value="{{$actor->id}}" type="checkbox" id="actor1" name="actor1">
                                            </td>
                                        </tr>
                                    @endforeach()
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary ">Submit</button>

                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection
