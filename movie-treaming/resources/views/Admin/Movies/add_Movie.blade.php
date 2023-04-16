@php use App\Http\Controllers\ActorController; @endphp
@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow ">
        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Add new Movie</p>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('save-movie') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="name">Movie Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter movie name">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label for="cover_image" class="form-label">Video</label>
                            <input class="form-control" type="file" id="server_link" name="server_link"
                                   value="{{ old('server_link') }}">
                            @if($errors->has('server_link'))
                                <span class="text-danger">{{ $errors->first('server_link') }}</span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-4">
                            <label for="poster_image" class="form-label">Poster Image Link</label>
                            <input class="form-control" type="file" id="poster_image" name="poster_image"
                                   value="{{ old('poster_image') }}">
                            @if($errors->has('poster_image'))
                                <span class="text-danger">{{ $errors->first('poster_image') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="cover_image" class="form-label">Cover Image Link</label>
                            <input class="form-control" type="file" id="cover_image" name="cover_image"
                                   value="{{ old('cover_image') }}">
                            @if($errors->has('cover_image'))
                                <span class="text-danger">{{ $errors->first('cover_image') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="trailerLink">Trailer Video Link</label>
                            <input type="text" class="form-control" id="trailer_video" name="trailer_video"
                                   placeholder="Enter trailer video link">
                            @if($errors->has('trailer_video'))
                                <span class="text-danger">{{ $errors->first('trailer_video') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="realased_date">Released Date</label>
                            <input type="number" max="2030" min="1950" class="form-control" id="realased_date"
                                   name="realased_date" placeholder="Enter release date (yyyy-mm-dd)">
                            @if($errors->has('released_date'))
                                <span class="text-danger">{{ $errors->first('released_date') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                   placeholder="Enter duration">
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
                                    <option value="{{$director->id}}">{{$director->full_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-sm-6">
                            <label for="languages">Language</label>
                            <input type="text" class="form-control" id="languages" name="languages"
                                   placeholder="Enter duration">
                            @if($errors->has('languages'))
                                <span class="text-danger">{{ $errors->first('languages') }}</span>
                            @endif

                        </div>


                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="3">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group mt-3 bg-light border rounded-3 p-3 row">
                        <div class="col-sm-6">
                            <label for="categories">Categories</label>
                            <select class="categoryId form-control" id="categories" name="categories[]" multiple>
                                @foreach(\App\Http\Controllers\CategoryController::getCategories() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
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
                                    <option value="{{$actor->id}}">{{$actor->full_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('actors'))
                                <span class="text-danger">{{ $errors->first('actors') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
