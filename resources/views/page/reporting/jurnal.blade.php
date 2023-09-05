@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px;">
        <form method="post" class="form-horizontal" style="text-align: start">
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
                                    <th>Act</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if ($item->masuk != 0 )
                                            <a href="{{ route('penerimaan.show', $item->uuid) }}"
                                                class="btn btn-primary fa fa-print" target="blank"></a>
                                            @else
                                            <a href="{{ route('pengeluaran.show', $item->uuid) }}"
                                                class="btn btn-primary fa fa-print" target="blank"></a>
                                            @endif
                                        </td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->masuk != 0 ? 'Terima dari' : 'Setor Ke' }} {{ $item->nama }} Rp.
                                            {{ $item->masuk != 0 ? number_format($item->masuk, 2, ',', '.') : number_format($item->keluar, 2, ',', '.') }}
                                            <br> Via {{ $item->akun }}
                                            {{ $item->remark }}
                                        <td></td>
                                        <td></td>
                                        <ul style="list-style: decimal">
                                            @foreach ($detail as $a)
                                                @if ($item->id == $a->transaksi_id)
                                                    @if ($item->masuk != 0)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $a->kode }} - {{ $a->akun != null ? $a->akun : $a->kode_tagihan }}
                                        </td>
                                        <td>Rp. {{ number_format($a->nominal, 2, ',', '.') }}</td>
                                        <td></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> {{ $a->akun != null ? $a->akun : $a->kode_tagihan }}</td>
                                        <td></td>
                                        <td>Rp. {{ number_format($a->nominal, 2, ',', '.') }}</td>
                                    </tr>
                                @endif
                                @endif
                                @endforeach

                                </td>
                                {{-- <tr style="background:rgb(134, 236, 134)">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Via {{ $item->akun }}</td>
                                    @if ($item->keluar != 0)
                                        <td></td>
                                        <td>Rp. {{ number_format($item->keluar, 2, ',', '.') }}</td>
                                    @endif
                                    @if ($item->masuk != 0)
                                        <td>Rp. {{ number_format($item->masuk, 2, ',', '.') }}</td>
                                        <td></td>
                                    @endif
                                </tr> --}}
                                </tr>
                            
                               
                                @endforeach
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
