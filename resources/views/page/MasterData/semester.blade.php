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
            <a data-toggle="modal"href="#add-smt" class="btn btn-primary" style="justify-items: end"><i
                    class="fa fa-plus"></i> Add Semester</a>
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
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>keterangan</th>
                                </tr>
                            </thead>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add-smt" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Tambah Semester</h4>
                    <form method="post" action="{{ URL::Route('semester.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Semester</label>

                            <div class="col-sm-10"><input type="text" placeholder="Semester" name="semester" required
                                    class="form-control"></div>
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
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>  
    <script src="{{ URL::asset('assets/injs/semester.js') }}"></script>
@endpush
