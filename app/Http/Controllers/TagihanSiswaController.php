<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\menu;
use Session;

class TagihanSiswaController extends Controller
{
    function index (){
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.dataTagihan',compact(['menu']));
    }
}
