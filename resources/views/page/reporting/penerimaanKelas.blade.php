@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px;">
        <form method="post" action="" class="form-horizontal" style="text-align: start">
            @csrf
            <div class="col-md-8">
                <div class="col-sm-3"><input type="date" placeholder="" id="tglawal" name="tanggalawal"
                      value="{{ $request ? $request->tanggalawal : '' }}"  required class="form-control"></div>
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
                                <th>Kampus</th>
                                <th>Kelas</th>
                                <th>jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->nama_unit}}</td>
                                    <td>{{$item->kelas}}</td>
                                    @foreach ($data as $jumlah)
                                    @if ($item->id == $jumlah->id_kelas)
                                        <td>{{$jumlah->jumlah}}</td>
                                    @endif
                                    @endforeach
                                    
                                </tr>
                            @endforeach
                        </tbody>

                            <tr >
                                <td></td>
                                <td></td>
                                <td >Total</td>
                                <td id="total"></td>
                            </tr>
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
@push('js')
<script>

function hitungTotal() {
    let table = document.getElementById("data-table");
    let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    let total = 0;

    for (let i = 0; i < rows.length; i++) {
        let cell = rows[i].getElementsByTagName("td")[3]; // Kolom kedua (index 1) berisi angka
        if (!isNaN(cell.textContent)) {
            total += parseFloat(cell.textContent);
        }
    }

    return total;
}

document.getElementById("total").textContent =  hitungTotal();

</script>
@endpush
