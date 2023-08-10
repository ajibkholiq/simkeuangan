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
            <button id="btn-add" class="btn btn-primary" style="justify-items: end"><i class="fa fa-plus"></i> Tambah Master Akun Head sub</button>
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
                                    tr {
                                        font-size:12px
                                    }
                                </style>
                                <tr style="font-size:12px">
                                    <th>Action</th>
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
           <div id="add-siswa" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Tambah master_akun_headSub</h4>
                        <form method="post" action="{{ URL::Route('akun_head_sub.store') }}"class="form-horizontal">
                            @csrf
                            <div class="hr-line-dashed"></div>
                             <div class="form-group"><label class="col-sm-3 control-label">Akun Head Sub</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" name="akun_head_sub" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Akun Head</label>
                                <div class="col-sm-9">
                                    <select name="akun_head_id" id="" class='form-control'>
                                        @foreach ($akun_head as $akun_head)
                                            <option value="{{ $akun_head->id }}">{{ $akun_head->akun_head }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Urut</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" name="urut" required
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
         <div id="edit-akun_headsub" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Ubah akun head sub</h4>
                        <div class="form-horizontal">
                            @csrf
                            <input type="hidden" id="uuid">
                           <div class="hr-line-dashed"></div>
                             <div class="form-group"><label class="col-sm-3 control-label">Akun Head Sub</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" id="nama" name="nama" required
                                        class="form-control"></div>
                            </div>
                           <div class="form-group"><label class="col-sm-3 control-label">Akun Head</label>
                                <div class="col-sm-9">
                                    <select name="akun_head_id" id="id" class='form-control'>
                                        @foreach ($akun_head as $akun_head_id)
                                            <option value="{{ $akun_head->id }}">{{ $akun_head->akun_head }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Urut</label>
                                <div class="col-sm-9"><input type="text" placeholder="Nama" id="urut"name="urut" required
                                        class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Remark</label>
                                <div class="col-sm-9"><input type="text" placeholder="Remark" id="remark" name="remark" required
                                        class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="text-align: end">
                                    <button class="btn btn-primary" id="ubahsiswa">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
   
    <script src="{{ URL::asset('assets/injs/akunheadsub.js') }}"></script>
  
@endpush
