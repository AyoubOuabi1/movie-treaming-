@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="text-dark mb-4">Movies</h3>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Movies Info</p>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <label>filter users by roles</label>
                    <select class="form-control" name="role" onchange="loadUsers()" id="role">
                        <option value="simple-user">Simple user</option>
                        <option value="moderator">Moderator</option>
                        <option value="super-admin">Super Admin</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div  class="text-md-end dataTables_filter"><label class="form-label"><input
                                class="form-control form-control-md" onkeyup="findMovie()" id="movieTable_filter" type="search" aria-controls="dataTable"
                                placeholder="Search by name"/></label></div>
                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                <table id="dataTable" class="table my-0">
                    <thead>
                    <tr>
                        <th>Full name</th>
                        <th>email</th>
                        <th>registered at</th>
                        <th>permissions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="userBody">

                    </tbody>

                </table>
            </div>

        </div>
    </div>
 @endsection
@section('scripts')
    <script>
        loadUsers()
    </script>
@endsection('scripts')
