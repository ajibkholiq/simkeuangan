<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMSTR;
use App\Helper\menu;
use Session;

class SemesterController extends Controller
{
        function index(){
        $menu = menu::getMenu(Session::get('role'));
        $data = SMSTR::all();
        return view('page.MasterData.semester',compact(['menu','data']));
    }
    function store(Request $request){
        $data = SMSTR::create([
            'uuid' => uniqid(),
            'semester' => $request->semester,
            'status' => $request->status,
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
        if ($request->status == 'AKTIF' ){
        $data = SMSTR::where('uuid',$uuid)->update([
                'status' => 'TIDAK', 
                'updated_by' => Session::get('nama')
            ]);
        }
        else {
        $data = SMSTR::where('uuid',$uuid)->update([
                'status' => 'AKTIF',
                'updated_by' => Session::get('nama')

            ]);
        }
        return response()->json($data, 200);
    }
    function destroy($id){
        $data = SMSTR::where('uuid',$id)->first();
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Tahun Pelajaran Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Tahun Pelajarannu Gagal dihapus');
        }
    }
}
