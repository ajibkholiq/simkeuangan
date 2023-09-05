@extends('layout.master')
@section('main')
    <div class="row">
        <div class="col-lg-12 " style="margin-top: 10px; margin-bottom:30px">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 20px">
                            <form action=""  method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="padding-top:8px"> Nama Siswa</label>
                                    <div class="col-sm-4"><input type="text" id="siswa" placeholder="Siswa"
                                            name="siswa" required class="form-control " value="{{$request->siswa ? : ''}}"></div>
                                    <button class="btn btn-primary">View</button>

                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Act</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <form action="{{ route('hapusHead', $item->uuid) }}"
                                                        onsubmit="alert('Anda Yakin Akan Menghapus Data Dengan No Transaksi {{ $item->id }}');"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-outline btn-danger fa fa-trash-o"></button>

                                                    </form>
                                                </td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->remark }} <br> Via : {{$item->Nama}}
                                                    <ul style="list-style: decimal">
                                                        @foreach ($detail as $a)
                                                            @if ($item->id == $a->transaksi_id)
                                                                <li>{{ $a->akun != null ? $a->akun : $a->kode_tagihan }} Rp.
                                                                    {{ number_format($a->nominal, 2, ',', '.') }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>Rp. {{ number_format($item->masuk, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ URL::asset('assets/js/plugins/typehead/bootstrap3-typeahead.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/siswa',
                type: 'get',
                success: (data) => {
                    $('#siswa').typeahead({
                        source: data.map(a => a.nis + '_' + a.nama),
                    })
                }
            });
        })
    </script>
@endpush
