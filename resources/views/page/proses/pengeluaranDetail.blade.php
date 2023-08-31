@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px;">
        <div class="col-md-6" style="margin-bottom: 30px">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="post" action="{{ URL::route('pengeluaran.store') }}" class="form-horizontal"
                        style="text-align: start">
                        @csrf
                        <input type="hidden" name="uuid" value="{{ $data->uuid }}">
                        <div class="form-group"><label class="col-sm-3 control-label">Tanggal</label>
                            <div class="col-sm-8"><input type="date" placeholder="" value="{{ $data->tanggal }}"
                                    name="tanggal" readonly class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Terima Dari</label>
                            <div class="col-sm-8"><input type="text" placeholder="Masukan Nama.."
                                    value="{{ $data->nama }}" readonly name="nama" class="form-control "></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Cabang</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Masukan Nama.." value="{{ $data->kampus }}" readonly
                                    name="unit" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Nama Akun</label>
                            <div class="col-sm-8">
                                <select name="akun" required class=" form-control">
                                    @foreach ($akun as $akun)
                                        <option value="{{ $akun->Nama }}">{{ $akun->Nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Via</label>
                            <div class="col-sm-8">
                                <select name="via" required class=" form-control">
                                    @foreach ($via as $via)
                                        <option value="{{ $via->kode }}">{{ $via->Nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-8"><input type="number" placeholder="Masukan Jumlah" name="jumlah" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Peruntukan</label>
                            <div class="col-sm-8"><input type="text" placeholder="Peruntukan" name="remark" required
                                    class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Total Nominal</label>
                            <div class="col-sm-8"><input type="text" value="{{ $data->keluar }}" disabled
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3" style="text-align: end">
                                <a href="{{route('pengeluaran.index')}}" class="btn btn-primary">Kembali</a>
                                <a href="{{route('pengeluaran.show',$data->uuid)}}" target="blank" class="btn btn-primary">Cetak Bukti</a>
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped">
                            <thead>
                                <style>
                                    /* th {
                                                text-align: center
                                            } */

                                    tr {
                                        font-size: 12px
                                    }
                                </style>
                                <tr style="font-size:12px">
                                    <th>No</th>
                                    <th>Action</th>
                                    <th>Nama Akun</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> 
                                            <form action="{{route('penerimaan.destroy',$item->uuid)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline btn-danger fa fa-trash-o"></button>
                                                
                                            </form> 
                                        </td>
                                        <td>{{ $item->kode_tagihan }}</td>
                                        <td>{{ $item->nominal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
