@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow" >
        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Add new Actor or Director</p>
        </div>

        <div class="card-body">
            <div class="row">
                <form action="{{ route('save-actor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="mb-3">
                            <label for="actor_image" class="form-label">Actor Image</label>
                            <input class="form-control" type="file" id="actor_image" name="actor_image" value="{{ old('actor_image') }}">
                            @if($errors->has('actor_image'))
                                <span class="text-danger">{{ $errors->first('actor_image') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label for="full_name">Actor Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Enter Actor full name">
                            @if($errors->has('full_name'))
                                <span class="text-danger">{{ $errors->first('full_name') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="born_in">Birthday</label>
                            <input type="date" class="form-control" id="born_in" name="born_in" value="{{ old('born_in') }}" placeholder="Enter actor birthday">
                            @if($errors->has('born_in'))
                                <span class="text-danger">{{ $errors->first('born_in') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="poster_image">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('Nationality') }}" placeholder="Enter Actor Nationality">
                            @if($errors->has('nationality'))
                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option disabled {{ old('role') == '' ? 'selected' : '' }}>Select Role</option>
                                <option value="Director" {{ old('role') == 'Director' ? 'selected' : '' }}>Director</option>
                                <option value="Actor" {{ old('role') == 'Actor' ? 'selected' : '' }}>Actor</option>
                            </select>
                            @if($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role') }} </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"  rows="3">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
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

        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection('scripts')
