@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px;">
        <div class="col-md-6">
            <form method="post" action="{{ URL::route('penerimaan.store') }}" class="form-horizontal" style="text-align: start">
                @csrf
                <div class="form-group"><label class="col-sm-3 control-label">Tanggal</label>
                    <div class="col-sm-8"><input type="date" placeholder="" id="tgl" name="tanggal" required
                            class="form-control"></div>
                </div>
                <script>
                    document.getElementById('tgl').valueAsDate = new Date();
                </script>
                <div class="form-group"><label class="col-sm-3 control-label">Terima Dari</label>
                    <div class="col-sm-8"><input type="text" placeholder="Masukan Nama.." name="nama"
                            required class="form-control "></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Cabang</label>
                    <div class="col-sm-8">
                        <select name="cabang" required class=" form-control">
                            <option value="">Pilih Unit</option> 
                            @foreach ($unit as $unit)
                                       <option value="{{$unit->nama_unit}}">{{$unit->nama_unit}}</option> 
                                    @endforeach
                        </select>
                    </div>
                </div>
                
                 <div class="form-group"><label class="col-sm-3 control-label">Nama Akun</label>
                    <div class="col-sm-8">
                        <select name="akun" required class=" form-control">
                            @foreach ($akun as $akun)
                                       <option value="{{$akun->Nama}}">{{$akun->Nama}}</option> 
                                    @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Via</label>
                    <div class="col-sm-8">
                        <select name="via" required class=" form-control">
                            <option value="">Pilih Via</option> 
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
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-3" style="text-align: end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
