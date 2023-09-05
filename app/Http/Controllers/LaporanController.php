<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\TransaksiHead;
use App\Models\Kelas;
use App\Helper\menu;
use Session;
use DB;
class LaporanController extends Controller
{
    function menu(){
      return menu::getMenu(Session::get('role'));
    }
    function getKelas($awal,$akhir){
       return  $kelas = Kelas::join('master_unit','master_unit.id','unit_id')
                        ->join('siswa','siswa.id_kelas','kelas.id')
                        ->join('transaksi_heads','siswa_id','siswa.id')->where('kode_trans','TAGIHAN')
                        ->whereBetween('transaksi_heads.tanggal', [$awal,$akhir])
                        ->select('nama_unit','kelas.id','kelas')->distinct()->get();
    }
    function getDataKelas($awal,$akhir){
        return  $data = TransaksiHead::leftJoin('siswa','siswa.id','siswa_id')->Join('kelas','id_kelas','kelas.id')
                        ->whereBetween('transaksi_heads.tanggal', [$awal, $akhir])
                        ->where('kode_trans','TAGIHAN')
                        ->select(DB::raw( 'id_kelas,sum(masuk) as jumlah'))->groupBy('id_kelas')->get();
    }
    function Penerimaan(Request $request){
        $menu = $this->menu();
        $data ;
        if ($request->tanggalawal){
            $data = TransaksiHead::whereIn('kode_trans',['PENERIMAAN','TAGIHAN'])->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])->get();
            // return $request ;
            
        } else {
            $data = TransaksiHead::whereIn('kode_trans',['PENERIMAAN','TAGIHAN'])->whereBetween('tanggal', [now()->startOfMonth(), now()->endOfMonth()])->get();
        }
        $detail = TransaksiDetail::leftJoin('tagihans','tagihans.kode','kode_tagihan')->leftJoin('akuns','akuns.id','akun_id')->select('transaksi_id','akuns.Nama as akun' ,'transaksi_details.nominal','transaksi_details.kode_tagihan')->get();
        return view ('page.reporting.penerimaan',compact(['menu','data','detail','request']));
        // return $detail ;
    }
    function pembayaranSiswa(Request $request){
        $menu = $this->menu();
        $data = TransaksiHead::join('siswa','siswa.id','siswa_id')->where('kode_trans','TAGIHAN')->where('siswa.nis',explode('_',$request->siswa)[0])
                            ->join('akuns','akuns.kode','kode_akun')
                            ->select('transaksi_heads.id','akuns.Nama','transaksi_heads.uuid','tanggal','transaksi_heads.remark','masuk')->get();
        $detail = TransaksiDetail::leftJoin('tagihans','tagihans.kode','kode_tagihan')->leftJoin('akuns','akuns.id','akun_id')->select('transaksi_id','akuns.Nama as akun' ,'transaksi_details.nominal','transaksi_details.kode_tagihan')->get();
        
        // if(!$request->siswa){
        return view ('page.reporting.pembayaranSiswa',compact(['menu','data','detail','request']));

        
        // return $data;
    }
    function penerimaanKelas(Request $request){
        $menu = $this->menu();
          if ($request->tanggalawal){
            $kelas = $this->getKelas($request->tanggalawal,$request->tanggalakhir);
            $data = $this->getDataKelas($request->tanggalawal,$request->tanggalakhir);
          }else {
            $kelas = $this->getKelas(now()->startOfMonth(), now()->endOfMonth());
            $data = $this->getDataKelas(now()->startOfMonth(), now()->endOfMonth());
          }
        return view ('page.reporting.penerimaanKelas',compact(['menu','kelas','data','request']));
        // return $kelas;
   
    }
    function summaryTagihan(Request $request){
        $menu = $this->menu();
        return view ('page.reporting.summaryTagihan',compact(['menu','request']));
   
    }
    function jurnal(Request $request){
          $menu = $this->menu();
        $data ;
        if ($request->tanggalawal){
            $data = TransaksiHead::whereIn('kode_trans',['PENERIMAAN','TAGIHAN','PENGELUARAN'])->join('akuns','akuns.kode','kode_akun')->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])->select('kode_trans','transaksi_heads.id','masuk','keluar','transaksi_heads.nama as nama','akuns.nama as akun','tanggal','transaksi_heads.uuid')->get();
            // return $request ;
            
        } else {
            $data = TransaksiHead::whereIn('kode_trans',['PENERIMAAN','TAGIHAN','PENGELUARAN'])->join('akuns','akuns.kode','kode_akun')->whereBetween('tanggal', [now()->startOfMonth(), now()->endOfMonth()])->select('kode_trans','transaksi_heads.id','masuk','keluar','transaksi_heads.nama as nama','akuns.nama as akun','tanggal','transaksi_heads.uuid')->get();
            
        }
        $detail = TransaksiDetail::leftJoin('tagihans','tagihans.kode','kode_tagihan')->leftJoin('akuns','akuns.id','akun_id')->select('transaksi_id','akuns.Nama as akun' ,'transaksi_details.nominal','transaksi_details.kode_tagihan','akuns.kode')->get();
        return view ('page.reporting.jurnal',compact(['menu','data','detail','request']));
        // return $data ;
   
    }
    function hapusHead ($id){
        if(TransaksiHead::where('uuid',$id)->delete()){
            return redirect()->back();
        }
    }
}
