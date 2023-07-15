<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmMenuController;
use App\Http\Controllers\AdmRoleMenu;
use App\Models\adm_menu;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
    return view('layout.master',compact('menu'));
    // return $menu;
});
Route::resource('adm-menu', AdmMenuController::class)->except('show');
Route::resource('adm-role-menu', AdmRoleMenu::class);


