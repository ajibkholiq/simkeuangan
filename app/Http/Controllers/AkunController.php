<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\menu;
use Session;
use App\Models\Akun;
use App\Models\Sub2Akun;

class AkunController extends Controller
{
    function index (){
        $sub = Sub2Akun::all();
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.MasterAkun',compact(['menu','sub']));
        // return $sub;
    }
    function store(Request $request){

         $data = Akun::create([
            'uuid' => uniqid(),
            'sub2_akun_id' => $request->id,
            'kode' => $request->kode,
            'Nama'  => $request->nama,
            'remark'  => $request->remark,
            'created_by'  => Session::get('nama'),
         ]);

                 if (!$data){
             return response()->json([
                "mesage" => "Gagal ditambahkan",
                'data' => $data
                ]
            );
        }
        return redirect()->back()->with('success','Akun Behasil ditambahkan');
    }
    function show($id){
        return response()->json(Akun::where('uuid',$id)->first(), 200);
    }
    function update($id, Request $request){
        $data = Akun::where('uuid',$id)->update([
            'sub2_akun_id' => $request->id,
            'kode' => $request->kode,
            'Nama'  => $request->nama,
            'remark'  => $request->remark,
            'updated_by'  => Session::get('nama'),
         ]);
    }
     function destroy($id){
        if(Akun::where('uuid',$id)->delete()){
            return response()->json(['succsess' => 'akun berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'akun gagal dihapus', 'data' => $id]);
    }
}
