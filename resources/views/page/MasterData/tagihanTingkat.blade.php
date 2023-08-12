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
                    class="fa fa-plus"></i> Generate</a>
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
                                    <th>Tahun Ajaran</th>
                                    <th>Tagihan</th>
                                    <th>Tingkat</th>
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
    <div id="add-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Generate Tagihan Tingkat</h4>
                    <form method="post" action="{{ URL::Route('tagihan_tingkat.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                          <div class="form-group"><label class="col-sm-3 control-label">Tahun pelajaran </label>
                                <div class="col-sm-9">
                                    <select name="tahun" id="" class='form-control'>
                                        @foreach ($thn as $th)
                                            <option value="{{ $th->id }}">{{ $th->tahun_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        <div class="form-group"><label class="col-sm-3 control-label">Tingkat</label>
                                <div class="col-sm-9">
                                    <select name="tingkat" id="" class='form-control'>
                                        @foreach ($sub as $sb)
                                            <option value="{{ $sb->id }}">{{ $sb->nama_tingkat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 " style="justify-content:end; display:flex; gap:2rem">
                                <p class="text-danger">Untuk Awal Tahun Pelajaran.!</p>
                                <button class="btn btn-primary" id="thn-save">Generate</button>
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
                    <h4>Edit Tagihan Tingkat</h4>
                    <div class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" id="uuid">
                          <div class="form-group"><label class="col-sm-3 control-label">Tahun Pelajaran</label>
                            <div class="col-sm-9"><input type="text" id="tahun" placeholder="Tahun Pelajaran" disabled required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tagihan</label>

                            <div class="col-sm-9"><input type="text" id="tagihan" placeholder="Tagihan" disabled  required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tingkat</label>

                            <div class="col-sm-9"><input type="text" id="tingkat" placeholder="Tingkat" disabled required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nominal</label>

                            <div class="col-sm-9"><input type="text" id="nominal" placeholder="Nominal"  required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" id="remark" placeholder="Keterangan" name="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="ubah">Ubah</button>
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
    <script src="{{ URL::asset('assets/injs/tghnTingkat.js') }}"></script>
@endpush
