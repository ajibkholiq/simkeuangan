<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\MasterUnit;
use App\Models\TransaksiDetail;
use App\Models\TransaksiHead;
use App\Helper\menu;
use Session;
use DB;
use PDF;

class PenerimaanController extends Controller
{
     function index(){
        $menu = menu::getMenu(Session::get('role')); 
        $unit = MasterUnit::all();
        $akun = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->join('master_akun_head_sub','master_akun_head_sub.id','sub_akun_id')->where('master_akun_head_sub.akun_head_sub','Sumbangan Donatur')->orWhere('master_akun_head_sub.akun_head_sub','pendapatan lain-lain')->select('akuns.kode','akuns.Nama')->get(); 
        $via = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->where('sub2_akuns.Nama','kas dan setara kas')->select('akuns.kode','akuns.Nama')->get(); 
        return view('page.proses.penerimaan',compact(['menu','akun','unit','via']));
        // return $akun;
    }
     function store(Request $request){
        $menu = menu::getMenu(Session::get('role')); 
        $akun = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->join('master_akun_head_sub','master_akun_head_sub.id','sub_akun_id')->where('master_akun_head_sub.akun_head_sub','Sumbangan Donatur')->orWhere('master_akun_head_sub.akun_head_sub','pendapatan lain-lain')->select('akuns.kode','akuns.Nama')->get(); 
        $via = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->where('sub2_akuns.Nama','kas dan setara kas')->select('akuns.kode','akuns.Nama')->get(); 
       
        if ($request->uuid){
            $data = TransaksiHead::where('uuid',$request->uuid)->first();
            $data->update([
            'kode_akun' => $request->via ,//sementara
            'masuk' => $data->masuk + $request->jumlah,
            'total_nominal' => $data->total_nominal + $request->jumlah,
            ]);
            TransaksiDetail::create([
                'uuid' => uniqid(),
                'transaksi_id' => $data->id,
                'kode_tagihan'=> $request->akun,
                'nominal' => $request->jumlah ,
                'remark' => $request->remark,
                'created_by'=> Session::get('nama'),
              ]);
            
        $detail = TransaksiDetail::where('transaksi_id',$data->id)->get();

        return view('page.proses.penerimaanDetail',compact(['menu','akun','data','via','detail']));

        }
         $uuid = uniqid();
        TransaksiHead::create([
            'uuid' => $uuid,
            'kode_trans' => 'PENERIMAAN',
            'tanggal' => $request->tanggal,
            'kode_akun' => $request->via ,//sementara
            'siswa_id' => '0',
            'nama' => $request->nama,
            'kampus' => $request->cabang,
            'masuk' => $request->jumlah,
            'keluar' => 0,
            'total_nominal' => $request->jumlah, //total
            'remark' => '-',
            'created_by' => Session::get('nama'),
        ]);
        
        $data = TransaksiHead::where('uuid',$uuid)->first();
            TransaksiDetail::create([
                'uuid' => uniqid(),
                'transaksi_id' => $data->id,
                'kode_tagihan'=> $request->akun,
                'nominal' => $request->jumlah ,
                'remark' => $request->remark,
                'created_by'=> Session::get('nama'),
              ]);
        $detail = TransaksiDetail::where('transaksi_id',$data->id)->get();
        return view('page.proses.penerimaanDetail',compact(['menu','akun','data','via','detail']));
        
     }

     function destroy($id){ 
        $a = TransaksiDetail::where('uuid',$id)->first();
        if($a != null){
        $data = TransaksiHead::where('id',$a->transaksi_id)->first();
        $menu = menu::getMenu(Session::get('role')); 
        $akun = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->join('master_akun_head_sub','master_akun_head_sub.id','sub_akun_id')->where('master_akun_head_sub.akun_head_sub','Sumbangan Donatur')->orWhere('master_akun_head_sub.akun_head_sub','pendapatan lain-lain')->select('akuns.kode','akuns.Nama')->get(); 
        $via = Akun::join('sub2_akuns','sub2_akuns.id','sub2_akun_id')->where('sub2_akuns.Nama','kas dan setara kas')->select('akuns.kode','akuns.Nama')->get(); 
       
      if(TransaksiDetail::where('uuid',$id)->delete())
      {
        $detail = TransaksiDetail::where('transaksi_id',$a->transaksi_id)->get();
        $data->update([
            'masuk' => $data->masuk - $a->nominal,
            'total_nominal' => $data->total_nominal - $a->nominal,
            ]);
        return view('page.proses.penerimaanDetail',compact(['menu','akun','data','via','detail']));
      }
      }
        return 'gagal, coba lagi!';
     }

     function show($id){
        $a = TransaksiHead::where('transaksi_heads.uuid',$id)->join('akuns','kode_akun','akuns.kode')->select('tanggal','transaksi_heads.nama','masuk','transaksi_heads.id','akuns.Nama as akun')->first();
        $b = TransaksiDetail::where('transaksi_id',$a->id)->get();

        $data = [
            'head' => $a,
            'detail' => $b,
        ];
        $pdf = PDF::loadview('page.Cetak.nonsiswa',$data);
        return $pdf->stream('penerimaan_'.$a->nama.'_'.$a->tanggal.'.pdf');
        // return $a;

     }
}
