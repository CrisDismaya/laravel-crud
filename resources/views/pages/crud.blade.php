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
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#user-modal-add" onclick="fieldsEmpty()">
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

<div class="modal fade" id="user-modal-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title" class="modal-title" id="myCenterModalLabel"> Title </h4>
                <button type="button" class="btn-sm btn-close modal-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="user-name">Name</label>
                                <input class="form-control" type="text" placeholder="Enter your name" id="user-name" />
                                <p class="error-message text-danger" id="user-name-error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="user-email">Email</label>
                                <input class="form-control" type="text" placeholder="Enter your email" id="user-email" />
                                <p class="error-message text-danger" id="user-email-error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="user-contact">Phone Number</label>
                                <input class="form-control" type="text" placeholder="XXXX XXX XXXX" id="user-contact" data-toggle="input-mask" data-mask-format="0000 000 0000"/>
                                <p class="error-message text-danger" id="user-contact-error"></p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light modal-close" data-bs-dismiss="modal">Close</button>
                <button id="save-user" type="button" class="btn btn-sm btn-outline-secondary" data-selected-id="0" onclick="saved()">
                    <span id="text"> Save Branch </span>
                    <span id="spinner" class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                </button>
            </div> <!-- end modal footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="user-modal-del" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel"> Delete Branch </h4>
                <button type="button" class="btn-sm btn-close modal-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row mb-1">
                        <label class="col-4 text-end col-form-label">Name :</label>
                        <div class="col-8">
                            <label  class="col-form-label view-name"> text </label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-4 text-end col-form-label">Email :</label>
                        <div class="col-8">
                            <label class="col-form-label view-email"> text </label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-4 text-end col-form-label">Phone Number :</label>
                        <div class="col-8">
                            <label class="col-form-label view-phone"> text </label>
                        </div>
                    </div>

                    <div class="row mb-1 px-5">
                        <div class="form-check form-checkbox-danger">
                            <input type="checkbox" class="form-check-input" id="delete-confirmation">
                            <label class="form-check-label" for="delete-confirmation">Are you sure you want to delete this item?</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light modal-close" data-bs-dismiss="modal">Close</button>
                <button id="delete-user" type="button" class="btn btn-sm btn-outline-danger" data-selected-id="0" onclick="deleted()">
                    <span id="text"> Delete Branch </span>
                    <span id="spinner" class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                </button>
            </div> <!-- end modal footer -->
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    <script>
        const closeModal = $('.modal-close')
        const addModal = $(`#user-modal-add`)
        const addModalTitle = addModal.find('#modal-title')
        const addButton = $(`#save-user`)
        const addSpinner = addButton.find('#spinner')
        const addButtonTextSpan = addButton.find('#text')

        const delModal = $(`#user-modal-del`)
        const delConfirm = $(`#delete-confirmation`)
        const delButton = $(`#delete-user`)
        const delSpinner = delButton.find('#spinner')
        const delButtonTextSpan = delButton.find('#text')

        $(document).ready(() => {
            table()
        });

        async function table(){
            try {
                const { code, users } = await $.ajax({
                    url: `/crud/show`,
                    type: 'GET',
                    dataType: 'json'
                });

                if ($.fn.DataTable.isDataTable(`#basic-datatable`)) {
                    $(`#basic-datatable`).DataTable().destroy();
                }

                var a = $(`#basic-datatable`).DataTable({
                    data: users, // Set the data for the DataTable
                    columns: [
                        { data: 'id', className: 'fw-semibold', visible: false, searchable: false },
                        { data: 'name', className: 'fw-semibold' },
                        { data: 'email' },
                        { data: 'contact', className: 'text-center' },
                        { data: null, defaultContent: '', className:'text-center',
                            render: function(data, type, row, meta){

                                html = `
                                    <i class="ri-edit-box-line font-20 text-warning cursor-pointer"
                                        onclick="view('update', ${ row.id }, '${ row.name }', '${ row.email }', '${ row.contact }')">
                                    </i>
                                    <i class="ri-subtract-line font-20 rotate-90"></i>
                                    <i class="ri-delete-bin-line font-20 text-danger cursor-pointer"
                                        onclick="view('delete', ${ row.id }, '${ row.name }', '${ row.email }', '${ row.contact }')">
                                    </i>
                                `;
                                return html;
                            }
                        },
                    ],
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
                        // $('.ellipsis-tooltip').tooltip()
                    }
                });
                a.buttons().container().appendTo("#basic-datatable_wrapper .col-md-6:eq(0)")
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function fieldsEmpty(){
            addModalTitle.text('Add User')
            $('#user-name').val('')
            $('#user-email').val('')
            $('#user-contact').val('')
            addButton.removeClass('btn-outline-warning').addClass('btn-outline-secondary')
            addButton.data('selected-id', "0")
            addSpinner.hide()
            addButtonTextSpan.text('Save')
        }

        function view(action, id, name, email, phone_number){
            switch (action) {
                case 'update':
                    addModal.modal('show')
                    addButton.data('selected-id', id)
                    $('#user-name').val(name)
                    $('#user-email').val(email)
                    $('#user-contact').val(phone_number)
                    addModalTitle.text('Edit User')
                    addButton.removeClass('btn-outline-secondary').addClass('btn-outline-warning')
                    addSpinner.hide()
                    addButtonTextSpan.text('Update')
                break;

                case 'delete':
                    delModal.modal('show')
                    delButton.data('selected-id', id)
                    $('.view-name').text(name)
                    $('.view-email').text(email)
                    $('.view-phone').text(phone_number)
                    delConfirm.prop('checked', false)
                    delSpinner.hide()
                break;
                default:
                    console.log('Contact the administrator');
            }
        }

        async function saved(){
            const id = parseInt(addButton.data('selected-id'))
            const fields = {
                id: id,
                name: $('#user-name').val(),
                email: $('#user-email').val(),
                contact: $('#user-contact').val().replace(/\s/g, ''),
            };
            const action = (id <= 0 ? true : false)
            // Note: True for Insert data, False for Update data

            closeModal.prop('disabled', true)
            addButton.prop('disabled', true)
            addButtonTextSpan.text('')
            addSpinner.show()

            try {
                if(action){
                    const response = await $.ajax({
                        url: `/crud/create`,
                        type: 'POST',
                        dataType: 'json',
                        data: fields
                    })
                }
                else {
                    const response = await $.ajax({
                        url: `/crud/${ id }`,
                        type: 'PATCH',
                        dataType: 'json',
                        data: fields
                    })
                }

                await table()
                setTimeout(() => {
                    addModal.modal('hide')
                    const message = `User <b>${ fields.name }</b> Successfully ${ action ? 'Added' : 'Updated' }!`;
                    showToast('success', message);

                    closeModal.prop('disabled', false)
                    addButton.prop('disabled', false)
                    addButtonTextSpan.text('Save')
                    addSpinner.hide()
                }, 2000);

            } catch (error) {
                const errors = error.responseJSON.errors

                $('.error-message').text('');
                Object.entries(errors).forEach(([field, messages]) => {
                    $(`#user-${field}-error`).text(messages[0]);
                });

                closeModal.prop('disabled', false)
                addButton.prop('disabled', false)
                addButtonTextSpan.text('Save')
                addSpinner.hide()
            }

        }

        async function deleted(){
            const id = parseInt(delButton.data('selected-id'))
            const fields = {
                id: id
            };

            if(!delConfirm.is(':checked')){
                delConfirm.focus()
                return;
            }

            delButtonTextSpan.text('');
            delSpinner.show();
            closeModal.prop('disabled', true)

            try {
                const response = await $.ajax({
                    url: `/crud/${ id }`,
                    type: 'DELETE',
                    dataType: 'json',
                    data: fields
                });

                await table()

                setTimeout(function () {
                    delModal.modal('hide')
                    const message = `User <b>${ response.users.name }</b> Successfully Deleted!`;
                    showToast('success', message);

                    delButtonTextSpan.text('Delete');
                    delSpinner.hide();
                    closeModal.prop('disabled', false)
                }, 2000);

            } catch (error) {
                const errors = error.responseJSON.errors;

                setTimeout(function () {
                    delButtonTextSpan.text('Delete');
                    delSpinner.hide();
                    closeModal.prop('disabled', false)
                }, 2000);
            }
        }
    </script>
@endsection
