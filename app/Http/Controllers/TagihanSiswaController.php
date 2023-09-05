<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\menu;
use App\Models\TagihanTingkat;
use App\Models\TagihanSiswa;
use App\Models\Siswa;

use Session;

class TagihanSiswaController extends Controller
{
    function index (){
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.dataTagihan',compact(['menu']));
    }

     function show($id){
        $data = Siswa::join('kelas','id_kelas','kelas.id')
                            ->join('master_tingkat','master_tingkat.id','kelas.tingkat_id')
                            ->join('tagihan_siswas','siswa_id','siswa.id')
                            ->join('tagihans','kode','tagihan_siswas.kode_tagihan')
                            ->select('tahun_ajaran','kelas.kelas','siswa.nama as siswa','tagihans.nama','nominal','tagihan_siswas.remark','kali','diskon','tagihan_siswas.uuid')
                            ->where('tagihan_siswas.uuid',$id)->first();
        return response()->json($data, 200);
     }
     function update($id,Request $request){
         TagihanSiswa::where('uuid',$id)->update([ 
            'kali' => $request->kali,
            'diskon' => $request->diskon,
            'nominal' => $request->nominal,
            'remark' => $request->remark,
            'updated_by' => Session::get('nama'),
        ]);
        return $request;
     }
     function destroy($id){
        $data = TagihanSiswa::where('uuid',$id)->first();
        if($data->delete()){
            return response()->json(['succsess' => 'Tagihan Tingkat berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Tagihan Tingkat gagal dihapus', 'data' => $id]);
    }


    //generate tagihan tingkat ke tagihan siswa
     function generate(){
        $siswa = Siswa::join('kelas','id_kelas','kelas.id')->join('master_tingkat','tingkat_id','master_tingkat.id')->select('siswa.id as siswa','master_tingkat.id as tingkat')->get();
        foreach ($siswa as $siswa){
           
                    $tagihanTingkat = TagihanTingkat::join('tahun_pelajaran','tahun_pelajaran.id','thn_ajaran_id')
                    ->join('tagihans','tagihans.id','tagihan_id')->where('tahun_pelajaran.status','AKTIF')
                    ->where('tingkat_id',$siswa->tingkat)->select('tahun_pelajaran','nominal','kode')->get();
                    foreach ($tagihanTingkat as $item){
                        TagihanSiswa::create([
                            'uuid' => uniqid(),
                            'siswa_id' => $siswa->siswa,
                            'tahun_ajaran' => $item->tahun_pelajaran,
                            'kode_tagihan' => $item->kode ,
                            'nominal' => $item->nominal,
                            'remark' => '-',
                            'created_by' => Session::get('nama').' by generate',
                        ]);  
                    }  
                 }
                  return redirect()->back()->with('success','Behasil digenerate');
                }
}
