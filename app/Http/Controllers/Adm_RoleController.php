<?php

namespace App\Http\Controllers;

use App\Models\adm_role;
use App\Models\adm_menu;
use Illuminate\Http\Request;

class Adm_RoleController extends Controller
{
//     private function getHeadMenu()
// {
//     // Kode Anda untuk mendapatkan menu kepala (head menu)
//     // Misalnya:
//     $menu = adm_role::select('kode_menu', 'nama_menu', 'route')
//         ->where('induk', 'head')
//         ->orderBy('kode_menu', 'asc')
//         ->get();

//     return $menu;
// }    

    
public function index()
{
    $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->where('induk','head')->orderBy('kode_menu','asc')->get();
    $adm_roles = adm_role::get();
    return view('page.adm_role.index', compact('adm_roles','menu'));
    // return $adm_roles;
}

    public function create()
    {
        return view('page.adm_role.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'uuid' => 'required|unique:adm_role|max:20',
        //     'nama_role' => 'required',
        //     'remark' => 'required|max:20',
        //     'create_by' => 'required|max:20',
        //     'update_by' => 'required|max:20', 
        // ]);

        $data = adm_role::create([
            'uuid' => uniqid(),
            'nama_role' => $request->nama_role,
            'remark' => $request->remark,
            // 'create_by' => $request->create_by,
            // 'update_by' => $request->update_by
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

    function edit($id)
    {
        $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->where('induk','head')->orderBy('kode_menu','asc')->get();
    $adm_role = adm_role::where('uuid', $id)->first();
    return view('page.adm_role.edit', compact('adm_role','menu'));
    }

    public function update(Request $request, $adm_role) 
{
    $data = adm_role::where('uuid',$adm_role)->update([
       
        'nama_role' => $request->nama_role,
        'remark' => $request->remark,
        // 'create_by' => $request->create_by,
        // 'update_by' => $request->update_by 
    ]);

    if (!$data) {
        return response()->json([
           "message" => "Gagal diedit",
           'data' => $data
        ]);
    } else {
        return redirect('adm-role')->with('success', 'Menu Behasil Diedit');
    }
}


public function destroy($id)
{
    $data = adm_role::where('uuid', $id)->delete();

    if ($data) {
        if($data){
            return redirect()->back()->with('success','Menu Behasil dihapus');
        }else{
            return redirect()->back()->with('fail','Menu Gagal dihapus');
            }
        
        }
    }
}