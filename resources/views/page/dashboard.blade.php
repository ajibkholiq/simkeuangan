@extends('layout.master')

@section('main')
    <div class="row " style="margin-top:20px">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Total</span>
                    <h5>Siswa</h5>
                </div>
                <div class="ibox-content">
                    <h1 style="padding: 10px 0"  class="no-margins">{{ $siswa }}</h1>
                    <div class="stat-percent font-bold text-success"> </i></div>
                    <small>Total Siswa</small>
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
                    <h1 style="padding: 10px 0"  class="no-margins">{{number_format($transaksi->pemasukan,2,',','.')}}</h1>
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
                    <h1 style="padding: 10px 0" class="no-margins">{{number_format($transaksi->pengeluaran,2,',','.')}}</h1>
                    <div class="stat-percent font-bold text-navy"> </div>
                    <small>Total Pengeluaran</small>
                </div>
            </div>
        </div>
        
    </div>
@endsection
