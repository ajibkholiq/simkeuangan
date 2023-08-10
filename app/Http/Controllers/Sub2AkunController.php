<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\menu;
use Session;
use App\Models\AkunHeadSub;
use App\Models\Sub2Akun;

class Sub2AkunController extends Controller
{
    function index (){
        $sub = AkunHeadSub::all();
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.sub2AkunHead',compact(['menu','sub']));
    }
    function store(Request $request){

         $data = Sub2Akun::create([
            'uuid' => uniqid(),
            'sub_akun_id' => $request->id,
            'Nama'  => $request->nama,
            'urut'  => $request->urut,
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
        return redirect()->back()->with('success','Sub Sub Akun Head Behasil ditambahkan');
    }
    function show($id){
        return response()->json(Sub2Akun::where('uuid',$id)->first(), 200);
    }
    function update($id, Request $request){
        $data = Sub2Akun::where('uuid',$id)->update([
            'sub_akun_id' => $request->id,
            'Nama'  => $request->nama,
            'urut'  => $request->urut,
            'remark'  => $request->remark,
            'updated_by'  => Session::get('nama'),
         ]);
    }
     function destroy($id){
        if(Sub2Akun::where('uuid',$id)->delete()){
            return response()->json(['succsess' => 'Unit berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Unit gagal dihapus', 'data' => $id]);
    }
    
}
