@extends('layout.blank-page')
@section('title', 'CRUD')

@section('custom-css')

@endsection

@section('content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">

                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">User Management</h4>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#branch-modal" >
                            <i class="uil-plus"></i> Add User
                        </button>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-striped nowrap w-100">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-sm-start">Contact</th>
                                    <th>Address</th>
                                    <th class="text-sm-start">Action</th>
                                </thead>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="branch-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel"> Add Branch </h4>
                <button type="button" class="btn-sm btn-close modal-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="branch-name">Name</label>
                                <input class="form-control" type="text" placeholder="Enter your name" id="branch-name" />
                                <p class="error-message text-danger" id="branch-name-error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="branch-province">Province</label>
                                <select id="branch-province" class="form-control select2-modal" data-toggle="select2-modal">
                                    <option value="">Select</option>
                                </select>
                                <p class="error-message text-danger" id="branch-province-error"></p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light modal-close" data-bs-dismiss="modal">Close</button>
                <button id="save-branches" type="button" class="btn btn-sm btn-outline-secondary" data-update-id="0">
                    <span id="text"> Save Branch </span>
                    <span id="spinner" class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                </button>
            </div> <!-- end modal footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom-js')
    <script>
        const mainDataTable = 'basic-datatable';
        $(document).ready(() => {
            console.log('Crud')
            table(mainDataTable)
        });

        function table(name){
            if ($.fn.DataTable.isDataTable(`#${ name }`)) {
                $(`#${ name }`).DataTable().destroy();
            }

            var a = $(`#${ name }`).DataTable({
                order: [[0, 'desc']],
                lengthChange: false,
                scrollX: true,
                responseive: true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel'
                    }
                ],
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    $('.ellipsis-tooltip').tooltip()
                }
            });
            a.buttons().container().appendTo("#basic-datatable_wrapper .col-md-6:eq(0)")
        }
    </script>
@endsection
