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
            <a data-toggle="modal"href="#add-thn" class="btn btn-primary" style="justify-items: end"><i
                    class="fa fa-plus"></i> Add Tahun Pelajaran</a>
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
                                    <th>Tahun Pelajaran</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add-thn" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Tambah Tahun Pelajaran</h4>
                    <form method="post" action="{{ URL::Route('tahun_pelajaran.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tahun Pelajaran</label>

                            <div class="col-sm-10"><input type="text" placeholder="Tahun Pelajaran" name="tahun"
                                    required class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="" required class=" form-control">
                                    <option value="TIDAK">TIDAK</option>
                                    <option value="AKTIF">AKTIF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10"><input type="text" placeholder="Keterangan" name="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2" style="text-align: end">
                                <button class="btn btn-primary" id="thn-save">Save</button>
                            </div>
                        </div>
                    </form>
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
    <script src="{{ URL::asset('assets/injs/thnPljrn.js') }}"></script>
@endpush
