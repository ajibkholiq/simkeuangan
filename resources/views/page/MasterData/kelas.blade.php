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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <style>
                                        th {
                                            text-align: center;
                                        }
                                    </style>
                                    <th>ID</th>
                                    <th>Kelas</th>
                                    <th>Tingkat</th>
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
                                        <td>{{ $data->kelas }}</td>
                                        <td>{{ $data->nama_tingkat }}</td>
                                        <td>{{ $data->remark }}</td>
                                        <td>{{ $data->created_by }}</td>
                                        <td>{{ $data->updated_by }}</td>
                                        <td style="display: flex; justify-content:center; gap: 10px">
                                            {{-- <a href="{{route('adm-menu.edit',$data->uuid)}}" class="btn btn-warning fa fa-pencil"></a> --}}
                                            <button id="btn-kelas" class="btn btn-outline btn-warning fa fa-pencil "
                                                id="aktif" data-id="{{ $data->uuid }}"></button>
                                            <form action="{{ route('kelas.destroy', $data->uuid) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');">
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
    <div id="add-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Tambah Kelas</h4>
                    <form method="post" action="{{ URL::Route('kelas.store') }}"class="form-horizontal">
                        @csrf
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Kelas</label>

                            <div class="col-sm-10"><input type="text" placeholder="Nama Kelas" name="kelas" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tingkat</label>
                            <div class="col-sm-10">
                                <select name="tingkat" id="" required class=" form-control">
                                    @foreach ($tingkat as $tingkat)
                                        <option value="{{ $tingkat->id }}">{{ $tingkat->nama_tingkat }}</option>
                                    @endforeach

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
    <div id="edit-kelas" class="modal in" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Edit Kelas</h4>
                    <div class="form-horizontal">
                        @csrf
                        <input type="hidden" id='uuid'>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Kelas</label>

                            <div class="col-sm-10"><input type="text" placeholder="Nama Kelas" name="kelas"
                                    id="kelas" required class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tingkat</label>
                            <div class="col-sm-10">
                                <select name="tingkat" id="tingkat" required class=" form-control">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Remark</label>
                            <div class="col-sm-10"><input type="text" placeholder="Remark" id="remark"
                                    name="remark" required class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2" style="text-align: end">
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
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ URL::asset('assets/modal.js') }}"></script>
@endpush
