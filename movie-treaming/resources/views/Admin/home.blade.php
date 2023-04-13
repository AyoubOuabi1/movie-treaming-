@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="row g-3 my-2">
        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{\App\Http\Controllers\CountController::countMovies()}}</h3>
                    <p class="fs-5">Total Movies</p>
                </div>
                <i class="bi bi-film fs-1 primary-text-color border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2 "  id="lessTwo">{{\App\Http\Controllers\CountController::countUsers()}}</h3>
                    <p class="fs-5 ">Total Users</p>
                </div>
                <i
                    class="bi bi-person-circle fs-1  border rounded-full secondary-bg p-3"></i>
            </div>
        </div>



        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{\App\Http\Controllers\CountController::countViews()}}</h3>
                    <p class="fs-5">Total views</p>
                </div>
                <i class="bi bi-check2-all fs-1 primary-text-color border rounded-full secondary-bg p-3"></i>
            </div>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Last Movies Added</p>

        </div>
        <div class="card-body overflow-auto" style="max-height: 32em">
            <div class="row">
                <div class="col-md-6 text-nowrap">

                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2 " role="grid" aria-describedby="dataTable_info">
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
@endsection
@section('scripts')
    <script>
       loadTopMovies()
    </script>
@endsection('scripts')
