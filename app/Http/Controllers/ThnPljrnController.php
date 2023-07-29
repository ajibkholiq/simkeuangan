<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelajaran;
use App\Helper\menu;

use Session;

class ThnPljrnController extends Controller
{
    function index(){
        $menu = menu::getMenu(Session::get('role'));
        $data = pelajaran::all();
        return view('page.MasterData.thnPlajaran',compact(['menu','data']));
    }
    function store(Request $request){
        $data = pelajaran::create([
            'uuid' => uniqid(),
            'tahun_pelajaran' => $request->tahun,
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
        $data = pelajaran::where('uuid',$uuid)->update([
                'status' => 'TIDAK', 
                'updated_by' => Session::get('nama')
            ]);
        }
        else {
        $data = pelajaran::where('uuid',$uuid)->update([
                'status' => 'AKTIF',
                'updated_by' => Session::get('nama')

            ]);
        }
        return response()->json($data, 200);
    }
    function destroy($id){
        $data = pelajaran::where('uuid',$id)->first();
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Tahun Pelajaran Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Tahun Pelajarannu Gagal dihapus');
        }
    }
}