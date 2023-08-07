<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MasterTingkat;
use App\Helper\menu;
use Session;

class KelasController extends Controller
{
    function index(){
        $menu = menu::getMenu(Session::get('role'));
        $data = kelas::join('master_tingkat','tingkat_id','master_tingkat.id')->select('kelas.id','kelas.uuid','kelas',
            'nama_tingkat', 
            'kelas.remark',
            'kelas.created_by',
            'kelas.updated_by')->get();
        $tingkat = MasterTingkat::all();
        return view('page.MasterData.kelas',compact(['menu','data','tingkat']));
    }
    function store(Request $request){
        $data = Kelas::create([
            'uuid' => uniqid(),
            'kelas' => $request->kelas,
            'tingkat_id' => $request->tingkat,
            'remark' => $request->remark,
            'created_by' => Session::get('nama')
        ]);
      

        if (!$data){
             return response()->json([
                "mesage" => "Gagal ditambahkan",
                'data' => $data
                ]
            );
        }
        return redirect()->back()->with('success','Tahun Pelajaran Behasil ditambahkan');
        
    }
    function update($uuid ,Request $request){
        $data = Kelas::where('uuid',$uuid)->update([
                'kelas' => $request->kelas,
                'tingkat' => $request->tingkat,
                'remark' => $request->remark,
                'updated_by' => Session::get('nama')
            ]);
        return response()->json($data, 200);
    }
   function show ($uuid){
        return response()->json(Kelas::where('uuid',$uuid)->first(), 200);
    }
    function destroy($id){
        $data = Kelas::where('uuid',$id)->first();
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Tahun Pelajaran Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Tahun Pelajarannu Gagal dihapus');
        }
    }
}