<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmMenuController;
use App\Models\adm_menu;
use App\Http\Controllers\Adm_RoleController;
use App\Models\adm_role;


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
    $menu = adm_menu::select('kode_menu','nama_menu','route')->where('induk','head')->orderBy('kode_menu','asc')->get();
    return view('layout.master',compact('menu'));
    // return $menu;
});

Route::get('/page', function () {
    return view('page.home');
});


Route :: resource('adm_role',Adm_RoleController::class);
Route::resource('adm-menu', AdmMenuController::class);
Route::get('menu/{$id}',[AdmMenuController::class ,'getEdit'])->name('edit');