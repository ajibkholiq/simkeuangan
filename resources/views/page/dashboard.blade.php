@extends('layout.master')

@section('main')
    <div class="row " style="margin-top:20px ;">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Hari Ini</span>
                    <h5>Transaksi</h5>
                </div>
                <div class="ibox-content">
                    <h1 style="padding: 10px 0" class="no-margins">{{ $siswa }}</h1>
                    <div class="stat-percent font-bold text-success"> </i></div>
                    <small>Total Transaksi</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Bulan ini</span>
                    <h5>Pemasukan</h5>
                </div>
                <div class="ibox-content">
                    <h1 style="padding: 10px 0" class="no-margins">{{ number_format($transaksi->pemasukan, 2, ',', '.') }}</h1>
                    <div class="stat-percent font-bold text-info"></i></div>
                    <small>Total Pemasukan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"> Bulan ini</span>
                    <h5>Pengeluaran</h5>
                </div>
                <div class="ibox-content">
                    <h1 style="padding: 10px 0" class="no-margins">{{ number_format($transaksi->pengeluaran, 2, ',', '.') }}
                    </h1>
                    <div class="stat-percent font-bold text-navy"> </div>
                    <small>Total Pengeluaran</small>
                </div>
            </div>
        </div>
    <div class="col-lg-12" style="margin-bottom:40px">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div>
                    <span class="">
                        <h4><strong>Grafik penerimaan dan pengeluaran tahun ini</strong></h4>
                                  
                    </span>
                    <div  style="position: absolute ; right: 50px ;top :20px">
                        <form action="" method="post" class="form-horizontal" style="display: flex; ">
                                @csrf
                                <label class="col-sm-3 control-label"> Tahun</label>
                                <div class="col-sm-9">
                                    <select name="tahun" style="width:100px" class='form-control'>
                                            <option value="">Pilih Tahun</option>

                                        @foreach ($tahun as $a)
                                            <option value="{{ $a->tahun }}">{{ $a->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
            
                                    <button class="btn btn-primary" >View</button>
                        </form>
                    </div>
                    <h4 class="m-b-xs">Masuk Rp. {{number_format($pemasukanTahun->pemasukan, 2, ',', '.')}}</h4>
                    <h4 class="m-b-xs">Keluar Rp.  {{number_format($pengeluaranTahun->pengeluaran, 2, ',', '.')}}</h4>
                </div>
                <div><iframe class="chartjs-hidden-iframe"
                        style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; inset: 0px;"></iframe>
                    <canvas id="lineChart" height="200" style="display: block; width: 560px; height: 200px;"
                        width="560"></canvas>
                </div>

                {{-- <div class="m-t-md">
                    <small class="pull-right">
                        <i class="fa fa-clock-o"> </i>
                        Update on 16.07.2015
                    </small>
                    <small>
                        <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a
                        level over $50,000.
                    </small>
                </div> --}}
            </div>
        </div>
    </div>
     </div>
@endsection
@push('js')

<script>
        $(document).ready(function() {

            var lineData = {
                labels: {!!json_encode($bulan)!!},
                datasets: [
                    {
                        label: "Masuk",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: {{json_encode($masuk)}}
                    },
                    {
                        label: "Keluar",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data:  {{json_encode($keluar)}}
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        });
    </script>
    <script src="{{ URL::asset('assets/js/plugins/chartJs/Chart.min.js')}}"></script>

    @endpush
