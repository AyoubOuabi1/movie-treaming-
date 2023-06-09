@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="text-dark mb-4">Actors/Directors</h3>
        <a href="{{ route('add-actor') }}"><button type="button" class="btn btn-primary" >Add new Actor/Director </button></a>

    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Actors/Directors Info</p>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">

                </div>
                <div class="col-md-6">
                    <div  class="text-md-end dataTables_filter"><label class="form-label"><input
                                class="form-control form-control-sm" onkeyup="findActor()" id="actoreTable_filter" type="search" aria-controls="dataTable"
                                placeholder="Search by name"/></label></div>
                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                <table id="dataTable" class="table my-0">
                    <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Born in</th>
                        <th>Nationality</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="actorBody">

                    </tbody>

                </table>
            </div>

        </div>
    </div>
 @endsection
@section('scripts')
    <script type="text/javascript">
        loadActors();
    </script>
@endsection('scripts')

