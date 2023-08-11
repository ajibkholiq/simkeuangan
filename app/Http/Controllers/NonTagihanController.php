<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\NonTagihan;
use Illuminate\Http\Request;
use App\Helper\menu;
use File;
use Session;

class NonTagihanController extends Controller
{
    function index(){
        $menu =menu::getMenu(session::get('role'));
        $akuns=Akun::all();
        return view('page.MasterData.non_tagihan',compact(['menu','akuns']));   

    }

    function store(request $request){
        $data = NonTagihan::create([
            'uuid' => uniqid(),
            'akun_id'=> $request->akun_id,
            'kode' => $request->kode,
            'nama' => $request->nama,
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
       return redirect()->back()->with('success','Non Tagihan Behasil ditambahkan');

        
    }

    function show($id){
        return response()->json(NonTagihan::where('uuid',$id)->first(),200);

        
    }

    function update($id,request $request) {
        $data =NonTagihan::where('uuid',$id)->update([
            'akun_id'=> $request->akuns,
            'kode'=> $request-> kode,
            'nama' =>$request-> nama,
            'remark'=>$request->remark,
            'created_by'=> session::get('nama')
        ]);
        if($data){
            return response()->json([
                "mesage" => "gagal diubah",
            ]);
        }
        return response()->json(['succsess' => 'data non tagihan berhasil ubah', 'data' => $request]);
        
    }

    function destroy($id){
        if (NonTagihan::where('uuid',$id)->delete()) {
            return response()->json(['succsess' => 'data berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'akun gagal dihapus', 'data' => $id]);
     }
        
 }
