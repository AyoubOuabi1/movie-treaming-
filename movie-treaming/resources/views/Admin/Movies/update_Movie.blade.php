@php use App\Http\Controllers\ActorController; @endphp
@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow " id="updateContainer">
        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">update Movie</p>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{route('save-update-movie',$movie->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="name">Movie Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$movie->name}}"
                                   placeholder="Enter movie name">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="serverLink">Server Link</label>
                            <input type="text" class="form-control" id="server_link" value="{{$movie->server_link}}"
                                   name="server_link" placeholder="Enter server link">
                            @if($errors->has('server_link'))
                                <span class="text-danger">{{ $errors->first('server_link') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-4 text-center">
                            <div>
                                <label for="poster_image" class="form-label">Current poster Image </label>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <img src="{{ $movie->poster_image}}" class="rounded" alt="actor image" height="200px"
                                     width="250px">
                            </div>
                            <div>
                                <label for="poster_image" class="form-label">new poster Image </label>
                                <input class="form-control" type="file" id="poster_image" name="poster_image">
                                @if($errors->has('poster_image'))
                                    <span class="text-danger">{{ $errors->first('poster_image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div>
                                <label for="poster_image" class="form-label">Current cover Image </label>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <img src="{{ $movie->cover_image}}" class="rounded" alt="actor image" height="200px"
                                     width="250px">
                            </div>
                            <div>
                                <label for="poster_image" class="form-label">new cover Image </label>
                                <input class="form-control" type="file" id="cover_image" name="cover_image">
                                @if($errors->has('cover_image'))
                                    <span class="text-danger">{{ $errors->first('cover_image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div>
                                <label for="poster_image" class="form-label">Current Trailer Video </label>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <iframe width="250px" height="200px" src="{{$movie->trailer_video}}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                            </div>
                            <div>
                                <label for="trailer_video" class="form-label">new Trailer Video Link </label>
                                <input type="text" class="form-control" value="{{$movie->trailer_video}}"
                                       id="trailer_video" name="trailer_video" placeholder="Enter trailer video link">
                                @if($errors->has('trailer_video'))
                                    <span class="text-danger">{{ $errors->first('trailer_video') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="realased_date">Released Date</label>
                            <input type="number" max="2030" min="1950" class="form-control" id="realased_date"
                                   name="realased_date" value="{{$movie->realased_date}}">
                            @if($errors->has('released_date'))
                                <span class="text-danger">{{ $errors->first('released_date') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" value="{{$movie->duration}}"
                                   name="duration" placeholder="Enter duration">
                            @if($errors->has('duration'))
                                <span class="text-danger">{{ $errors->first('duration') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 mt-3 p-3 row">
                        <div class="col-sm-6">
                            <label for="directorId">Director</label>
                            <select class="directorId form-control" id="directorId" name="directorId">
                                @foreach(ActorController::getDirectors() as $director)
                                    <option value="{{$director->id}}" {{ $director->id==$movie->directorId ? 'selected':'' }}>{{$director->full_name}}</option>

                                    <option value="{{$director->id}}">{{$director->full_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-sm-6">
                            <label for="languages">Language</label>
                            <input type="text" class="form-control" value="{{$movie->languages}}" id="languages"
                                   name="languages" placeholder="Enter duration">
                            @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif


                        </div>


                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="3">{{ $movie->description }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>


                    <div class="form-group mt-3 bg-light border rounded-3 p-3 mt-3 row">

                        <div class="col-sm-6">
                            <label for="categories">Categories</label>
                            <select class="categoryId form-control" name="categories[]" multiple="multiple">
                                @foreach(\App\Http\Controllers\categoryController::getCategories() as $category)
                                    <option value="{{$category->id}}" {{ in_array($category->id,$movie->categories->pluck('id')->toArray()) ? 'selected':'' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categories'))
                                <span class="text-danger">{{ $errors->first('categories') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label for="actors">Actors</label>
                            <select class="actorId form-control" id="actors" name="actors[]" multiple>
                                @foreach(ActorController::getActors() as $actor)
                                    <option value="{{$actor->id}}" {{ in_array($actor->id,$movie->actors->pluck('id')->toArray()) ? 'selected':'' }}>{{$actor->full_name}}</option>

                                @endforeach
                                @if($errors->has('actors'))
                                    <span class="text-danger">{{ $errors->first('actors') }}</span>
                                @endif
                            </select>

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
@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $('#description').summernote();
        });
    </script>
@endsection('scripts')
