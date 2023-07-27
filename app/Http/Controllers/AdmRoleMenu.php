<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adm_role;
use App\Models\adm_menu;


class AdmRoleMenu extends Controller
{

    function getHeadMenu (){
        return adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
    
    }
    function index(){
        $data = adm_menu::orderBy('kode_menu','asc')->get();
        $role = adm_role::all();
        $menu = $this->getHeadMenu();
        return view('page.AdmRoleMenu.index',compact(['role','menu','data']));
        // return $data;
    }
    function store(Request $request){
        return $request;
    }
}
