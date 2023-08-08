@extends('layout.master')
@push('css')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <!--datatable responsive css-->
    @endpush
@section('main')
    <div class="row" style="margin-top:10px">
        @if (session('success'))
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <a class="alert-link" href="#">Berhasil.! </a>{{ session('success') }}
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <a data-toggle="modal"href="#add-form" class="btn btn-primary" style="justify-items: end"><i
                    class="fa fa-plus"></i> Add User</a>
        </div>

        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <style>
                                        th {
                                            text-align: center;
                                        }
                                        td {
                                            text-transform: capitalize
                                        }
                                    </style>
                                    <th>Action</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Role</th>

                                </tr>
                            </thead>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add-form" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('page.AdmUser.create')
                </div>
            </div>
        </div>
    </div>
    <div id="edit-form" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('page.AdmUser.edit')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let table = new DataTable("#data-table", {
        processing: false,
        ordering: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            emptyTable: "Tidak ada data",
        },
        ajax: {
            url: "/api/pegawai",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    if(data.role !== 'admin'){
                    return `
                    <div style="display:flex; gap:8px; justify-content: start">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline btn-warning fa fa-pencil " data-uuid="${data.uuid}"></button></div>
                   `;}
                   return '';
                },
            },
            { title: "Nama", data: "nama" },
            { title: "Username", data: "username" },
            { title: "Email", data: "email" },
            { title: "Alamat", data: "alamat" },
            { title: "No Hp", data: "nohp" },
            { title: "Role", data: "role" },
        ],
    });
});
        $('body').on('click', '#bt-edit', function() {
            let uuid = $(this).data('uuid');
            $.ajax({
                url: '/pegawai/' + uuid,
                type: 'get',
                success: function(data) {
                    $('#id').val(data.uuid);
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#nohp').val(data.nohp);
                    $('#alamat').val(data.alamat);
                    $('#role').val(data.role);
                    $('#edit-form').modal('show');

                }
            });
        });

        $('#save').on('click', function() {
            let uuid = $('#id').val();
            console.log(uuid);

            $.ajax({
                url: '/pegawai/' + uuid,
                type: 'PUT',
                data: {
                    'nama': $('#nama').val(),
                    'username': $('#username').val(),
                    'email': $('#email').val(),
                    'nohp': $('#nohp').val(),
                    'alamat': $('#alamat').val(),
                    'role': $('#role').val(),
                    '_token': $("input[name='_token']").val(),
                    '_method': 'PUT'
                },
                success: function(response) {
                    console.log(response);
                    $('#edit-form').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 100);
                }
            });
        });
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/pegawai/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            setTimeout(() => {
                location.reload();
            }, 100);
        },
    });
});
    </script>
@endpush
