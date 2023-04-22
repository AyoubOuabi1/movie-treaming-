@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="text-dark mb-4">Users</h3>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Users Info</p>

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
                                class="form-control form-control-md" onkeyup="loadUsers()" id="userTable_filter" type="search" aria-controls="dataTable"
                                placeholder="Search by email or name"/></label></div>
                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                <table id="dataTable" class="table my-0">
                    <thead>
                    <tr>
                        <th>Full name</th>
                        <th>email</th>
                        <th>registered at</th>
                        <th> </th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody id="userBody">

                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <input class="form-control" type="text" id="userName" name="userName"  readonly>

                    </div>
                    <div class="form-group bg-light border rounded-3 p-3 mt-3 row">
                        <select class="form-control" name="user-role"  id="user-role">

                            <option value="simple-user">Simple user</option>
                            <option value="moderator">Moderator</option>
                            <option value="super-admin">Super Admin</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer" id="modalfooter">


                </div>
            </div>
        </div>
    </div>
 @endsection
@section('scripts')
    <script>
        loadUsers()
    </script>
@endsection('scripts')
