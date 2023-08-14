<?php

namespace App\Http\Controllers;
use App\Models\pelajaran;
use App\Models\MasterTingkat;
use App\Models\TagihanTingkat;
use App\Models\Tagihan;
use App\Helper\menu;
use Session;
use Illuminate\Http\Request;

class TagihanTingkatController extends Controller
{
    function index(){
        $thn = pelajaran::where('status','AKTIF')->get();
        $sub = MasterTingkat::all();
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.tagihanTingkat',compact(['menu','sub','thn']));
    }

    function store(Request $request){
        $tagihan = Tagihan::join('tahun_pelajaran','tahun_pelajaran.id','thn_ajaran_id')
                                ->where('tahun_pelajaran.id',$request->tahun)
                                ->select('tagihans.id')
                                ->get();
          
        foreach ($tagihan as $tagih){
           TagihanTingkat::create([ 
            'uuid' => uniqid(),
            'thn_ajaran_id' => $request->tahun,
            'tagihan_id'=> $tagih->id,
            'tingkat_id' => $request->tingkat,
            'nominal' => '0',
            'remark' => '-',
            'created_by' => Session::get('nama'),
            ]);
        }
        return redirect()->back()->with('success','Tagihan Behasil ditambahkan');
    }
    function show($id){
        return response()->json(TagihanTingkat::join('tahun_pelajaran','tahun_pelajaran.id','thn_ajaran_id')
                                ->join('tagihans','tagihans.id','tagihan_id')
                                ->join('master_tingkat','tingkat_id','master_tingkat.id')
                                ->where('tagihan_tingkats.uuid',$id)
                                ->select('tagihan_tingkats.uuid','tahun_pelajaran','nominal','tagihans.nama','tagihan_tingkats.remark','master_tingkat.nama_tingkat')
                                ->first(), 200);
    }

    function update ($id , Request $request){
        TagihanTingkat::where('uuid',$id)->update([ 
            'nominal' => $request->nominal,
            'remark' => $request->remark,
            'updated_by' => Session::get('nama'),
        ]);
        return $request;
    }

     function destroy($id){
        $data = TagihanTingkat::where('uuid',$id)->first();
        if($data->delete()){
            return response()->json(['succsess' => 'Tagihan Tingkat berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Tagihan Tingkat gagal dihapus', 'data' => $id]);
    }
}
