<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelajaran;
use App\Models\Siswa;
use App\Models\Akun;
use App\Models\TransaksiDetail;
use App\Models\TransaksiHead;
use App\Helper\menu;
use Session;
use DB;
use PDF;

class TransaksiSiswaController extends Controller
{
      function index(){
        $menu = menu::getMenu(Session::get('role'));    
        $akun = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->where('sub2_akuns.Nama','kas dan setara kas')->select('akuns.kode','akuns.Nama')->get(); 
        return view('page.proses.transaksiSiswa',compact(['menu','akun']));
        // return $akun;
    }
     function transaksiDetail(Request $request){
      $data = $request;
      $menu = menu::getMenu(Session::get('role')); 
      $tagihan = Siswa::join('tagihan_siswas','siswa_id','siswa.id')
                            ->join('tagihans','tagihans.kode','tagihan_siswas.kode_tagihan')
                            ->select('tagihans.kode','tagihans.nama as tagihan','nominal',
                            DB::raw('nominal - (select sum(a.nominal) from transaksi_details a,transaksi_heads b where a.transaksi_id = b.id and a.kode_tagihan = tagihan_siswas.kode_tagihan and siswa.id = b.siswa_id and b.siswa_id = tagihan_siswas.siswa_id and tagihan_siswas.kode_tagihan = a.kode_tagihan) as "sisa"') )
                            ->where('nis',explode('_',$request->siswa)[0])->where(DB::raw('IFNULL(nominal - (select sum(a.nominal) from transaksi_details a,transaksi_heads b where a.transaksi_id = b.id and a.kode_tagihan = tagihan_siswas.kode_tagihan and siswa.id = b.siswa_id and b.siswa_id = tagihan_siswas.siswa_id and tagihan_siswas.kode_tagihan = a.kode_tagihan),1)'),'!=',0)
                            ->get();
      return view('page.proses.transaksiDetailSiswa', compact(['menu','data','tagihan']));
      // return $tagihan;
     }

     function store (Request $request){
        $siswa = Siswa::join('kelas','kelas.id','id_kelas')
                        ->join('master_unit','master_unit.id','unit_id')
                        ->select('siswa.id','master_unit.unit','siswa.nama')
                        ->where('nis',explode('_',$request->siswa)[0])->first();
        $uuid = uniqid();

        TransaksiHead::create([
            'uuid' => $uuid,
            'kode_trans' => 'TAGIHAN',
            'tanggal' => $request->tanggal,
            'kode_akun' => $request->via ,//sementara
            'siswa_id' => $siswa->id ,
            'nama' => $siswa->nama,
            'kampus' => $siswa->unit,
            'masuk' => $request->total,
            'keluar' => 0,
            'total_nominal' => preg_replace("/[^0-9]/", "", $request->total), //total
            'remark' => $request->remark,
            'created_by' => Session::get('nama'),
        ]);

        $idTransaksiHead  = TransaksiHead::join('siswa','siswa_id','siswa.id')
                                          ->join('kelas','kelas.id','id_kelas')
                                          ->join('akuns','kode_akun','akuns.kode')
                                          ->select('transaksi_heads.id','siswa.nama as nama','masuk','tanggal','kelas','akuns.nama as akun','siswa.nis')
                                          ->where('transaksi_heads.uuid',$uuid)->first();
         
        foreach ($request->kode as $key => $kode){
          if($request->nominal[$key] != 0){
              TransaksiDetail::create([
                'uuid' => uniqid(),
                'transaksi_id' => $idTransaksiHead->id,
                'kode_tagihan'=> $kode,
                'nominal' => $request->nominal[$key] ,
                'remark' => '-',
                'created_by'=> Session::get('nama'),
              ]);
          }  
        } 

        $detail = TransaksiDetail::join('tagihans','kode_tagihan','tagihans.kode')
                                  ->where('transaksi_id',$idTransaksiHead->id)->get();
        $data =   [
          'head' => $idTransaksiHead,
          'detail' => $detail,
        ];
        $pdf = PDF::loadview('page.Cetak.transaksiSiswa',$data);
      // return view('page.Cetak.transaksiSiswa',compact(['detail','idTransaksiHead']));
        
      return $pdf->stream('bayar_'.$idTransaksiHead->nis.'_'.$idTransaksiHead->nama.'_'.$idTransaksiHead->tanggal.'.pdf');
    }
}
