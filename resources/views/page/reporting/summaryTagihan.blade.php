@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px;">
        <form method="post" action=""" class="form-horizontal" style="text-align: start">
            @csrf
            <div class="col-md-8">
                <div class="col-sm-3"><input type="date" placeholder="" id="tglawal" name="tanggalawal"
                        value="{{ $request ? $request->tanggalawal : '' }}" required class="form-control"></div>
                <div class="col-sm-3"><input type="date" placeholder="" id="tglakhir" name="tanggalakhir"
                        value="{{ $request ? $request->tanggalakhir : '' }}" required class="form-control"></div>
                    <button class="btn btn-primary">View</button>
                
            </div>

        </form>


    <div class="col-lg-12 " style="margin-top: 10px; margin-bottom:30px">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><form action="{{route('hapusHead',$item->uuid)}}" onsubmit="alert('Anda Yakin Akan Menghapus Data Dengan No Transaksi {{$item->id}}');" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"  class="btn btn-outline btn-danger fa fa-trash-o"></button>
                                                
                                            </form> </td>
                                    <td>{{$item->id}}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>Terima dari {{ $item->nama }} {{ $item->remark }}
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
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     @if (!$request->tanggalawal)
        <script>
            function getFirstAndLastDayOfMonth(date) {
                var year = date.getFullYear();
                var month = date.getMonth();

                // Tanggal awal bulan
                var firstDay = new Date(year, month, 1);

                // Tanggal akhir bulan
                var lastDay = new Date(year, month + 1, 0);

                return {
                    firstDay,
                    lastDay
                };
            }
            var tanggalSekarang = new Date();
            var {
                firstDay,
                lastDay
            } = getFirstAndLastDayOfMonth(tanggalSekarang);
            document.getElementById('tglawal').valueAsDate = firstDay;
            document.getElementById('tglakhir').valueAsDate = lastDay;
        </script>
    @endif
    </div>
@endsection
