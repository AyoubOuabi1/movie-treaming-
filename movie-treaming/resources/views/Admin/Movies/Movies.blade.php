@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="text-dark mb-4">Movies</h3>
        <a href="{{ route('addMovie') }}"><button type="button" class="btn btn-primary" >Add new Movie </button></a>

    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Movies Info</p>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">

                </div>
                <div class="col-md-6">
                    <div  class="text-md-end dataTables_filter"><label class="form-label"><input
                                class="form-control form-control-sm" onkeyup="getMovie()" id="movieTable_filter" type="search" aria-controls="dataTable"
                                placeholder="Search by name"/></label></div>
                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                <table id="dataTable" class="table my-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Views</th>
                        <th>Added in</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="movieBody">

                    </tbody>

                </table>
            </div>

        </div>
    </div>
    @include('Admin/Movies/Movie_modal')
@endsection
