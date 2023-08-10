<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use App\Models\MasterTingkat;
use App\Models\MasterUnit;
use App\Helper\menu;
use Session;

class KelasController extends Controller
{
    function index(){
        $menu = menu::getMenu(Session::get('role'));
        
        $user = User::where('role','wali kelas')->get();
        $tingkat = MasterTingkat::get();
        $unit = MasterUnit::get();
         
        return view('page.MasterData.kelas',compact(['menu','user','tingkat','unit']));
        // return $tingkat;
    }
    function store(Request $request){
        $data = Kelas::create([
            'uuid' => uniqid(),
            'kelas' => $request->kelas,
            'kode_kelas' => $request->kode,
            'tingkat_id' => $request->tingkat,
            'unit_id' => $request->kampus,
            'user_id' => $request->wali,
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
                'kode_kelas' => $request->kode,
                'tingkat_id' => $request->tingkat,
                'unit_id' => $request->kampus,
                'user_id' => $request->wali,
                'remark' => $request->remark,
                'updated_by' => Session::get('nama')
            ]);
        return response()->json($data, 200);
    }
   function show ($uuid){
        return response()->json(kelas::join('master_tingkat','tingkat_id','master_tingkat.id')
            ->join('master_unit','unit_id','master_unit.id')
            ->join('users','user_id','users.id')
            ->select('kelas.id','kelas.uuid','kelas','kode_kelas','unit_id','tingkat_id', 'kelas.remark','user_id')->first(), 200);
    }
    function destroy($id){
        $data = Kelas::where('uuid',$id)->first();
        $data->delete();
        if($data->delete()){
            return response()->json(['succsess' => 'Unit berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Unit gagal dihapus', 'data' => $id]);
}}
