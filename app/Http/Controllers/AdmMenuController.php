<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adm_menu;

class AdmMenuController extends Controller
{

    function getHeadMenu (){
        return adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
    
    }

    function index (){
        $data = adm_menu::all();
        $menu = $this->getHeadMenu();
        return view('page.AdmMenu.index',compact('data','menu'));
        // return $menu;

    }

    function store(Request $request){
        $data = adm_menu::create([
            'induk' => $request->induk,
            'uuid' => uniqid(),
            'kode_menu' => $request->kode,
            'icon' => "",
            'urut' => "",
            'nama_menu' => $request->nama,
            'route' => $request->route,
            'remark' => $request->remark
            // 'update_by'=> Auth::user()->id,
            // create_by => Auth::user()->id
        ]);

        if (!$data){
             return response()->json([
                "mesage" => "Gagal ditambahkan",
                'data' => $data
                ]
            );
        }else{
        return redirect()->back()->with('success','Menu Behasil ditambahkan');
        }
    }

    function edit ($id){
        $data = adm_menu::where('uuid',$id)->first();
        $menu = $this->getHeadMenu();

        return view('page.AdmMenu.edit',compact('data','menu'));

    }

    function show($id){
        $data = adm_menu::where('uuid',$id)->get();
        return $data;
        // return adm_menu::findOrFail($id);

    }
    function update($id, Request $request){
        $data = adm_menu::where('uuid',$id)->update([
            'induk' => $request->induk,
            'kode_menu' => $request->kode,
            'nama_menu' => $request->nama,
            'route' => $request->route,
            'remark' => $request->remark
            // 'update_by'=> Auth::user()->id
            ]
        );

          if (!$data){
             return response()->json([
                "mesage" => "Gagal diedit",
                'data' => $data
                ]
            );
        }else{
        return redirect('adm-menu')->with('success','Menu Berhasil diedit');
        }
    }
    function destroy($id){
        $data = adm_menu::where('uuid',$id)->first();

        if ( $data->induk == 'head' )
        {
            adm_menu::where('induk', $data->nama_menu)->delete();
        }
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Menu Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Menu Gagal dihapus');
        }
    }
}