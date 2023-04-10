@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="card shadow" >
        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">update Actor or Director</p>
        </div>

        <div class="card-body">
            <div class="row">
                <form action="{{ route('save-update-actor', $actor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-md-3 col-sm-12 d-flex justify-content-center">
                            <img src="{{ $actor->actor_image }}" class="rounded" alt="actor image" height="200px" width="250px">
                        </div>

                        <div class="col-md-9 col-sm-12">
                            <div class="mb-3">
                                <label for="actor_image" class="form-label">Actor Image</label>
                                <input class="form-control" type="file" id="actor_image" name="actor_image">
                                @if($errors->has('actor_image'))
                                    <span class="text-danger">{{ $errors->first('actor_image') }}</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="full_name">Actor Name</label>
                                <input type="text" class="form-control " value="{{ $actor->full_name }}" id="full_name" name="full_name" placeholder="Enter Actor full name">
                                <span class="text-danger">{{ $errors->first('full_name') }}</span>
                            </div>

                            <div class="col-sm-6">
                                <label for="born_in">Actor Birthday</label>
                                <input type="date" class="form-control " value="{{ $actor->born_in }}" id="born_in" name="born_in" placeholder="Enter actor birthday">
                                <span class="text-danger">{{ $errors->first('born_in') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <div class="col-sm-6">
                            <label for="poster_image">Nationality</label>
                            <input type="text" class="form-control  " value="{{ $actor->nationality }}" id="nationality" name="nationality" placeholder="Enter Actor Nationality">
                            <span class="text-danger">{{ $errors->first('nationality') }}</span>
                        </div>

                        <div class="col-sm-6">
                            <label for="role">Role</label>
                            <select class="form-control " name="role" id="role">
                                <option disabled selected>Select Role</option>
                                <option value="Director"{{ $actor->role === 'Director' ? ' selected' : '' }}>Director</option>
                                <option value="Actor"{{ $actor->role === 'Actor' ? ' selected' : '' }}>Actor</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        </div>
                    </div>

                    <div class="form-group bg-light border rounded-3 p-3 mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control " name="description" id="description" rows="3">{{ $actor->description }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button
                            type="submit"  class="btn btn-primary ">Update</button>

                    </div>

                </form>
             </div>

        </div>
    </div>

@endsection
