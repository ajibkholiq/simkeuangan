@extends('layout.master')
@section('main')
    @push('css')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <!--datatable responsive css-->
    @endpush
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
            <button id="btn-add" class="btn btn-primary" style="justify-items: end"><i class="fa fa-plus"></i> Add
                Unit</button>
        </div>

        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped">
                            <thead>
                                <style>
                                    th {
                                        text-align: center
                                    }
                                </style>
                                <tr style="">
                                    <th style="text-align: center">Action</th>
                                    <th>Unit</th>
                                    <th>Nama </th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Logo</th>
                                    <th>Remark</th>
                                    <th>Created by</th>
                                    <th>Update by</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="add-siswa" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Tambah Unit</h4>
                        <form method="post" action="{{ URL::Route('unit.store') }}" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-3 control-label">Unit</label>

                                <div class="col-sm-9"><input type="text" placeholder="Unit" name="unit" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" name="nama" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-9"><input type="text" placeholder="Alamat" name="alamat" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">No Telephone</label>
                                <div class="col-sm-9"><input type="text" placeholder="No Telephone" name="nohp"
                                        required class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Logo</label>
                                <div class="col-sm-9"><input type="file" placeholder="Logo" name="logo" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Remark</label>
                                <div class="col-sm-9"><input type="text" placeholder="Remark" name="remark" required
                                        class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="edit-siswa" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Ubah Unit</h4>
                        <div class="form-horizontal">
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-3 control-label">Unit</label>
                                <div class="col-sm-9"><input type="text" placeholder="Unit" name="unit" id="unit"
                                        required class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" name="nama"
                                        id="nama" required class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-9"><input type="text" placeholder="Alamat" name="alamat"
                                        id="alamat" required class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">No Telephone</label>
                                <div class="col-sm-9"><input type="text" placeholder="No Telephone" name="nohp"
                                        id="nohp" required class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Remark</label>
                                <div class="col-sm-9"><input type="text" placeholder="Remark" name="remark"
                                        id="remark" required class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                    <button class="btn btn-primary" id="ubah">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ URL::asset('assets/injs/unit.js') }}"></script>
@endpush
