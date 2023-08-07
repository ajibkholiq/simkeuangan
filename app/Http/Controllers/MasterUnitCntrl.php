<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\menu;
use App\Models\MasterUnit;
use File;
use Session;

class MasterUnitCntrl extends Controller
{
    function index(){
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.unit',compact(['menu']));
    }
    function store(Request $request){
        $image = $request->file('logo');
        $imageName = str_replace(' ','_' ,$request->nama).'_'.uniqid().'.'.$image->getClientOriginalExtension();
        $data = MasterUnit::create([
            'uuid' => uniqid(),
            'unit' => $request->unit,
            'nama_unit' => $request->nama,
            'alamat_unit' => $request->alamat,
            'no_tlp' => $request->nohp,
            'logo' => $imageName,
            'remark'  => $request->remark,
            'created_by'  => Session::get('nama'),
        ]);

        $image->move(public_path('assets/img/unit'),$imageName);
        

          if (!$data){
             return response()->json([
                "mesage" => "Gagal ditambahkan",
                'data' => $data
                ]
            );
        }
        return redirect()->back()->with('success','Unit Behasil ditambahkan');
    
    }
    function show($id){
        return response()->json(MasterUnit::where('uuid',$id)->first(), 200);
    }

    function update($id , Request $request){
      $data = MasterUnit::where('uuid',$id)->update([
            'unit' => $request->unit,
            'nama_unit' => $request->nama,
            'alamat_unit' => $request->alamat,
            'no_tlp' => $request->nohp,
            'remark'  => $request->remark,
            'updated_by' => Session::get('nama')
          ]);

          if(!$data){
             return response()->json([
                "mesage" => "Gagal diubah",
                ]
            );
        }
        return response()->json(['succsess' => 'Unit berhasil ubah', 'data' => $data]);
    }
     function destroy($id){
        $data = MasterUnit::where('uuid',$id)->first();
        File::delete('assets/img/unit/'.$data->logo);
        if($data->delete()){
            return response()->json(['succsess' => 'Unit berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Unit gagal dihapus', 'data' => $id]);
    }
}
