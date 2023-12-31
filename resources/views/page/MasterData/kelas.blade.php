@extends('layout.master')
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
            <a data-toggle="modal"href="#add-kelas" class="btn btn-primary" style="justify-items: end"><i
                    class="fa fa-plus"></i> Add Kelas</a>
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
                                    <th>Kode Kelas</th>
                                    <th>Nama</th>
                                    <th>Tingkat</th>
                                    <th>Wali Kelas</th>
                                    <th>Kampus</th>
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
                    <h4>Tambah Kelas</h4>
                    <form method="post" action="{{ URL::Route('kelas.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">kode</label>

                            <div class="col-sm-9"><input type="text" placeholder="Kode Kelas" name="kode" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nama Kelas</label>

                            <div class="col-sm-9"><input type="text" placeholder="Nama Kelas" name="kelas" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tingkat</label>
                            <div class="col-sm-9">
                                <select name="tingkat" required class=" form-control">
                                    @foreach ($tingkat as $tk)
                                        <option value="{{ $tk->id }}">{{ $tk->nama_tingkat }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Wali Kelas</label>
                            <div class="col-sm-9">
                                <select name="wali" required class=" form-control">
                                    @foreach ($user as $usr)
                                        <option value="{{ $usr->id }}">{{ $usr->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Kampus</label>
                            <div class="col-sm-9">
                                <select name="kampus" required class=" form-control">
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_unit }}</option>
                                    @endforeach

                                </select>
                            </div>
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
    <div id="edit-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Edit Kelas</h4>
                    <div class="form-horizontal">
                        @csrf
                        <input type="hidden" id='uuid'>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">kode</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Kode Kelas" name="kode" id='kode' required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nama Kelas</label>
                            <div class="col-sm-9"><input type="text" placeholder="Nama Kelas" name="kelas"
                                    id="kelas" required class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tingkat</label>
                            <div class="col-sm-9">
                                <select name="tingkat" id="tingkat" required class=" form-control">
                                    @foreach ($tingkat as $tk)
                                        <option value="{{ $tk->id }}">{{ $tk->nama_tingkat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Wali Kelas</label>
                            <div class="col-sm-9">
                                <select name="wali" id="wali" required class=" form-control">
                                    @foreach ($user as $usr)
                                        <option value="{{ $usr->id }}">{{ $usr->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Kampus</label>
                            <div class="col-sm-9">
                                <select name="kampus" id="kampus" required class=" form-control">
                                    @foreach ($unit as $itm)
                                        <option value="{{ $itm->id }}">{{ $itm->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" placeholder="Keterangan" id="remark"
                                    name="remark" required class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="kelas-save">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endpush
@push('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> // export pdf --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> // export pdf --}}
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script> {{-- print --}}
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ URL::asset('assets/injs/kelas.js') }}"></script>
@endpush
