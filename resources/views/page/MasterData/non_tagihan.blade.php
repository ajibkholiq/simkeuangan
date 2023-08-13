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
            <a data-toggle="modal"href="#add-kelas" class="btn btn-primary"  style="justify-items: end"><i
                    class="fa fa-plus"></i>Tambah Non Tagihan</a>
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
                                    <th>Akun</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="add-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Tambah Tagihan</h4>
                    <form method="post" action="{{ URL::Route('non_tagihan.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                          <div class="form-group"><label class="col-sm-3 control-label">Kode Akun </label>
                                 <div class="col-sm-9">
                                 <select name="akun_id" id="" class='form-control'>
                                        @foreach ($akuns as $akun)
                                            <option value="{{ $akun->id }}">{{ $akun->Nama }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                            </div> 
                          <div class="form-group"><label class="col-sm-3 control-label">Kode NonTagihan</label>

                            <div class="col-sm-9"><input type="text" placeholder="Kode Akun" name="kode" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nama</label>

                            <div class="col-sm-9"><input type="text" placeholder="Nama Tagihan" name="nama" required
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
                    <h4>Edit Akun</h4>
                    <div class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" id="uuid">
                          <div class="form-group"><label class="col-sm-3 control-label"> Kode Akun</label>
                                <div class="col-sm-9">
                                    <select name="akun_id" id="akuns" class='form-control'>
                                        @foreach ($akuns as $akun)
                                            <option value="{{ $akun->id }}">{{ $akun->Nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                          <div class="form-group"><label class="col-sm-3 control-label">Kode Non Tagihan</label>

                            <div class="col-sm-9"><input type="text" id="kode" placeholder="Kode Tagihan" name="kode" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nama</label>

                            <div class="col-sm-9"><input type="text" id="nama" placeholder="Nama Tagihan" name="nama" required
                                    class="form-control"></div>
                        </div>
                        
                        <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9"><input type="text" id="remark" placeholder="Keterangan" name="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                <button class="btn btn-primary" id="btn-ubah">Save</button>
                            </div>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> // export pdf --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> // export pdf --}}
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script> {{-- print--}}
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>  <script src="{{ URL::asset('assets/injs/nontagihan.js') }}"></script>
@endpush