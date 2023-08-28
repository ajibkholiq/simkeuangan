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
            <a data-toggle="modal"href="#generate" class="btn btn-primary" style="justify-items: end">Generate</a>
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
                                    <th>Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Kode Tagihan</th>
                                    <th>Kali</th>
                                    <th>Diskon</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="generate" class="modal in" aria-hidden="true">
            <div class="modal-dialog panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-warning"></i> Warning
                </div>
                <div class="panel-body">
                    <ul>
                        <li>
                        pastikan dilakukan di awal tahun pelajaran.
                       </li>
                        <li>
                        pastikan untuk menyelesaikan tagihan tingkat terlebih dahulu!
                       </li>
                        <li>
                        pastikan untuk cuma satu <a href="/tahun_pelajaran">tahun pelajaran yang aktif! </a>
                       </li>
                    </ul>
                      <div class="hr-line-dashed"></div>

                    <a href="{{ route('generate') }}" class="btn btn-primary" style="text-align: end">Generate</a>
                </div>
            </div>
        </div>
        <div id="edit" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Edit Tagihan Siswa</h4>
                    <div class="form-horizontal">
                        @csrf
                        <input type="hidden" id='uuid'>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" id='siswa' disabled class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Kelas</label>
                            <div class="col-sm-9"><input type="text" id="kelas" disabled class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tahun Pelajaran</label>
                            <div class="col-sm-9">
                                <input type="text" id="thn" disabled class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tagihan</label>
                            <div class="col-sm-9">
                                <input type="text" id="tagihan" disabled class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Kali</label>
                            <div class="col-sm-9"><input type="number" placeholder="Kali" id="kali"
                                     required class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Diskon (%)</label>
                            <div class="col-sm-9"><input type="number" placeholder="Diskon" id="diskon"
                                     required class="form-control"></div>
                        </div>
                         <div class="form-group"><label class="col-sm-3 control-label">Nominal</label>
                            <div class="col-sm-9"><input type="number" placeholder="Nominal" id="nominal"
                                     required class="form-control"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" placeholder="Keterangan" id="remark"
                                    name="remark" required class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="save">Save</button>
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
    <script src="{{ URL::asset('assets/injs/dataTagihan.js') }}"></script>
@endpush
