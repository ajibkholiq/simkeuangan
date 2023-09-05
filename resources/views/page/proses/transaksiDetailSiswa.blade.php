@extends('layout.master')
@section('main')
    <div class="row" style="margin-top:20px">
        <form method="post" action="{{ route('transaksi_siswa.store') }}" id="download" class="form-horizontal" target="_blank" style="text-align: start">
            <div class="col-md-5">
                @csrf
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal</label>
                    <div class="col-sm-8"><input type="date" value="{{ $data->tanggal }}" readonly name="tanggal"
                            class="form-control"></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Via</label>
                    <div class="col-sm-8">
                        <select name="via" required class=" form-control" readonly>
                            <option value="{{ $data->via }}">{{ $data->via }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Siswa</label>
                    <div class="col-sm-8"><input type="text" readonly value="{{ $data->siswa }}" name="siswa"
                            class="form-control "></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-8"><input type="text" value="{{ $data->remark }}" readonly name="remark" required
                            class="form-control"></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Total</label>
                    <div class="col-sm-8"><input type="text" value="0" readonly name="total" id='total' required
                            class="form-control"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-3" style="text-align: end">
                        <a href="{{ URL::route('transaksi_siswa.index') }} " class="btn btn-primary"> <i
                                class="fa fa-arrow-left"></i> Kembali</a>
                        <button class="btn btn-primary" >Simpan</button>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="ibox-content" style="border-radius:10px">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped">
                            <thead>
                                <style>
                                    th {
                                        text-align: center
                                    }
                                </style>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tagihan </th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <span id="tot" style="display: none">{{ count($tagihan) }}</span>
                                @foreach ($tagihan  as $item)
                               {{-- @if ($item->sisa !=0 && $item->sisa == null) --}}
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td> <span style="text-transform: uppercase">{{ $item->tagihan }}</span> <input
                                                type="hidden" name="kode[]" value="{{ $item->kode }}"><br> Sisa Tagihan : Rp.
                                            @if ($item->sisa == null)
                                                 {{ $item->nominal }}      
                                            @else
                                                 {{ $item->sisa }}        
                                            @endif
                                                 </td>
                                        <td class="col-md-6" style="text-align:center">
                                            <input oninput="aget_total()" type="number"
                                            id="jumlah{{ $loop->index + 1 }}" value="0" name="nominal[]" required class="form-control"></td>
                                    </tr>
                                {{-- @endif --}}
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        function aget_total() {
            var num = [1];
            var tot = $('#tot').text();
            var total = 0;
            for (i = 1; i <= tot; i++) {
                total += parseInt(document.getElementById('jumlah' + i).value);
            }
            console.log(total);


            // ubah total jadi ada titiknya
            // totalbaru = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var totalbaru = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // string 50.000


            //$("#total").html(totalbaru);
            //$("#total").val(total);
            document.getElementById('total').value = "Rp. " + totalbaru;
            console.log(tot);
            console.log(total);
            console.log(totalbaru);
        }
    </script>
      <script>
    document.addEventListener('DOMContentLoaded', function () {
        var downloadForm = document.getElementById('download');
        
        downloadForm.addEventListener('submit', function (event) {
            event.preventDefault(); 
            downloadForm.submit();
            setTimeout(function () {
            window.location.href = "{{ route('transaksi_siswa.index') }}"; 
            }, 2000); // Setelah pengalihan, tunggu 1 detik sebelum mengirimkan formulir
        });
    });
</script>
  
@endpush
