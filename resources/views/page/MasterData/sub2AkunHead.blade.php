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
            <a data-toggle="modal"href="#add-kelas" class="btn btn-primary" style="justify-items: end"><i
                    class="fa fa-plus"></i> Add Sub Sub Akun Head</a>
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
                                    </style>
                                    <th>Action</th>
                                    <th>Akun Head Sub Sub</th>
                                    <th>Akun Head Sub</th>
                                    <th>Akun Head</th>
                                    <th>Urut</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Tambah Sub Sub Akun Head</h4>
                    <form method="post" action="{{ URL::Route('sub_sub_akun.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nama</label>

                            <div class="col-sm-9"><input type="text" placeholder="Nama sub sub akun" name="nama" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Sub Akun Head </label>
                                <div class="col-sm-9">
                                    <select name="id" id="" class='form-control'>
                                        @foreach ($sub as $sb)
                                            <option value="{{ $sb->id }}">{{ $sb->akun_head_sub }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Urut</label>
                            <div class="col-sm-9"><input type="number" placeholder="Urut" name="urut" required
                                    class="form-control"></div>
                        </div> 
                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" placeholder="Keterangan" name="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="thn-save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="edit" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Edit Sub Sub Akun Head</h4>
                    <div class="form-horizontal">
                         @csrf
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" id="uuid">
                        <div class="form-group"><label class="col-sm-3 control-label">Nama</label>

                            <div class="col-sm-9"><input type="text" placeholder="Nama sub sub akun" name="nama" id="nama" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Sub Akun Head </label>
                                <div class="col-sm-9">
                                    <select name="id" id="id" class='form-control'>
                                        @foreach ($sub as $sb)
                                            <option value="{{ $sb->id }}">{{ $sb->akun_head_sub }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Urut</label>
                            <div class="col-sm-9"><input type="number" placeholder="Urut" name="urut" id="urut" required
                                    class="form-control"></div>
                        </div> 
                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" placeholder="Keterangan" name="remark" id="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="btn-ubah">Ubah</button>
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
    <script src="{{ URL::asset('assets/injs/sub2akunh.js') }}"></script>
@endpush
