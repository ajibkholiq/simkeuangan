<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adm_role;
use App\Models\adm_menu;
use App\Models\adm_role_menu;
use Illuminate\Support\Facades\DB;


class AdmRoleMenu extends Controller
{

    function getHeadMenu (){
        return adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
    
    }
    function index(){
        $test = DB::select('select nama_menu , nama_role from adm_menu,adm_role,adm_role_menu where adm_menu.id = adm_role_menu.menu_id and adm_role.id = adm_role_menu.role_id ');
        $data = adm_menu::orderBy('kode_menu','asc')->get();
        $role = adm_role::all();
        $menu = $this->getHeadMenu();

        return view('page.AdmRoleMenu.rolemenu',compact(['role','menu','data','test']));

        // return $tesr;
    }
    function store(Request $request){
    if ( $request != null){
        foreach ($request->idRole as $role) {
            adm_role_menu::where('role_id' ,$role)->delete();
            foreach ( $request->idMenu as $menu) {
                adm_role_menu::create([
                    "uuid" => uniqid(),
                    'role_id' => $role,
                    'menu_id' => $menu,
                    'create_by' => '',
                ] );
                
            }
        }
        return redirect()->back()->with(['success' => 'menu untuk role telah dibuat!']);
    }
    }

    function show($id){
        return $id;

    }
}
