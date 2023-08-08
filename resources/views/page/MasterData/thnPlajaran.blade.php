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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <style>
                                        th {
                                            text-align: center;
                                        }
                                    </style>
                                    <th>ID</th>
                                    <th>Tahun Pelajaran</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Create by</th>
                                    <th>Update by</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $data)
                                    <tr style="text-align: center">

                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->tahun_pelajaran }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->remark }}</td>
                                        <td>{{ $data->created_by }}</td>
                                        <td>{{ $data->updated_by }}</td>
                                        <td style="display: flex; justify-content:center; gap: 10px">
                                            {{-- <a href="{{route('adm-menu.edit',$data->uuid)}}" class="btn btn-warning fa fa-pencil"></a> --}}
                                            <button id="btn-act-thnpljrn"
                                                class="btn btn-outline {{ $data->status == 'AKTIF' ? 'btn-warning fa fa-check-square-o ' : 'btn-primary fa fa-square-o ' }} "
                                                id="aktif" data-id="{{ $data->uuid }}"
                                                data-status="{{ $data->status }}"></button>
                                            <form action="{{ route('tahun_pelajaran.destroy', $data->uuid) }}"
                                                method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline btn-danger fa fa-trash-o"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
                        <div class="form-group"><label class="col-sm-2 control-label">Remark</label>
                            <div class="col-sm-10"><input type="text" placeholder="Remark" name="remark" required
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
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ URL::asset('assets/modal.js') }}"></script>
@endpush
