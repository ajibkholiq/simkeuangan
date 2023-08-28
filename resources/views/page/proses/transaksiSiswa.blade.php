@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px">
        <div class="col-md-5">
            <form method="post" action="{{URL::route('transaksiDetail')}}" class="form-horizontal" style="text-align: start">
                @csrf
                <div class="form-group"><label class="col-sm-3 control-label">Tanggal</label>
                    <div class="col-sm-8"><input type="date" placeholder="Batas Bayar" id="tgl" name="tanggal" required class="form-control"></div>
                </div>
                <script>
                    document.getElementById('tgl').valueAsDate = new Date();
                </script>
                 <div class="form-group"><label class="col-sm-3 control-label">Via</label>
                            <div class="col-sm-8">
                                <select name="via" required class=" form-control">
                                    @foreach ($akun as $akun)
                                       <option value="{{$akun->kode}}">{{$akun->Nama}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                <div class="form-group"><label class="col-sm-3 control-label">Siswa</label>
                    <div class="col-sm-8"><input type="text" id="siswa" placeholder="Siswa" name="siswa" required
                            class="form-control "></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-8"><input type="text" placeholder="Keterangan" name="remark" required
                            class="form-control"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-3" style="text-align: end">
                        <button class="btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@push('js')
<script src="{{ URL::asset('assets/js/plugins/typehead/bootstrap3-typeahead.min.js')}}"></script>
<script>
    $(document).ready(function (){
      let nameSiswa; 
      $.ajax({
        url: '/api/siswa',
        type: 'get',
        success: (data)=>{
            $('#siswa').typeahead({
            source : data.map(a=> a.nis +'_'+ a.nama ),
        })
        }
     });

      
   })
</script>
@endpush