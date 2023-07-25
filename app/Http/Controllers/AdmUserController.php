<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\adm_menu;
use App\Models\adm_role;



class AdmUserController extends Controller
{
    function index(){
       $data = User::all();
       $role = adm_role::all();
       $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
        return view('page.AdmUser.index',compact('data','menu','role'));

    }
     function store(Request $request){
        $data = User::create([
        'uuid' => uniqid(),
        'nama' => $request->nama,
        'username' => $request->username,
        'password' => md5($request->password),
        'email' => $request->email,
        'nohp' => $request->nohp,
        'alamat'  => $request->alamat,
        'role' => $request->role,
        'foto' => '',
        'create_by' => $request->session()->get('id')
        ]);
        // return $request;
        if (!$data){
             return response()->json([
                "mesage" => "Gagal ditambahkan",
                'data' => $data
                ]
            );
        }
        return redirect()->back()->with('success','User Behasil ditambahkan');
        
    }

    function show ($uuid){
        return response()->json(User::where('uuid',$uuid)->first(), 200,);
    }

    function update($id, Request $request){
        $data = User::where('uuid',$id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'role' => $request->role
        ]);
        if ($data){
         return response()->json(['success' => 'data berhasil dirubah', 'data'=> $data]);
        }
         return response()->json(['success' => 'data gagal dirubah', 'data'=> $data]);

    }

     function destroy($id){
        $data = User::where('uuid',$id)->first();
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Menu Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Menu Gagal dihapus');
        }
    }
}
