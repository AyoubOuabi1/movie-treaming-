@extends('Admin.layouts.baseLayout')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h3 class="text-dark mb-4">Movies</h3>
        <button type="button" class="btn btn-primary" onclick="showNewCategoryContainer()">Add new Category</button>

    </div>
    <div class="d-flex justify-content-around form-group  d-none p-3 mt-3 row" id="newMovieContainer">
        <div class="col-4">
             <input class="form-control" type="text" id="categoryName" name="categoryName" placeholder="Entre Category name" >

        </div>
        <div class="col-4">
            <button type="button" class="btn btn-primary" onclick="insertCategory()" >save</button>
            <button type="button" class="btn btn-danger" onclick="hideNewCategoryContainer()" >cancel</button>

        </div>
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
                                class="form-control form-control-sm" onkeyup="findCategory()" id="categoryTable_filter" type="search" aria-controls="dataTable"
                                placeholder="Search by name"/></label></div>
                </div>
            </div>
            <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                <table id="dataTable" class="table my-0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Created in</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="categoryBody">

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
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" id="newName" name="newName"  >

                </div>
                <div class="modal-footer" id="modalfooter">


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        loadCategories();

    </script>
@endsection('scripts')
