<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Tagihan;
use App\Models\pelajaran;
use App\Helper\menu;
use Session;


class TagihanController extends Controller
{
    function index(){
        $thn = pelajaran::where('status','AKTIF')->get();
        $sub = Akun::all();
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.Tagihan',compact(['menu','sub','thn']));
    }
    function store(Request $request){
      $data = Tagihan::create([
            'uuid' => uniqid(),
            'thn_ajaran_id' => $request->tahun,
            'akun_id' => $request->akun,
            'kode' => $request->kode,
            'nama'  => $request->nama,
            'batas_bayar'  => $request->btsbyr,
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
        return redirect()->back()->with('success','Tagihan Behasil ditambahkan');
    }
     function show($id){
        return response()->json(Tagihan::where('uuid',$id)->first(), 200);
    }
     function update($id, Request $request){
        $data = Tagihan::where('uuid',$id)->update([
            'thn_ajaran_id' => $request->tahun,
            'akun_id' => $request->akun,
            'kode' => $request->kode,
            'nama'  => $request->nama,
            'batas_bayar'  => $request->btsbyr,
            'remark'  => $request->remark,
            'updated_by'  => Session::get('nama'),
         ]);
         return response()->json(['berhasil']);
        }

       function destroy($id){
        if(Tagihan::where('uuid',$id)->delete()){
            return response()->json(['succsess' => 'Unit berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Unit gagal dihapus', 'data' => $id]);
    }
}
