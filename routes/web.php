<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmMenuController;
use App\Http\Controllers\AdmRoleMenu;



use App\Http\Controllers\loginController;
use App\Models\adm_menu;
use App\Models\User;
use App\Http\Controllers\Adm_RoleController;
use App\Http\Controllers\AdmUserController;
use App\Models\adm_role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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
    return view('page.user.profile',compact('menu'));
    // return $menu;
});
Route::get('/ajib' , function (){
    return view('page.home');
});
Route::resource('adm-menu', AdmMenuController::class);
Route::get('menu/{$id}',[AdmMenuController::class ,'getEdit'])->name('edit');
Route::resource('adm-role-menu',AdmRoleMenu::class);
Route::resource('adm_role',Adm_RoleController::class);

Route::get('/login', [loginController::class , 'index' ])->name('login');
Route::get('/logout', [loginController::class , 'logout' ])->name('logout');
Route::post('/validate', [loginController::class , 'validasi' ])->name('validate');
Route::middleware('checklogin')->group(function () {
    Route::get('/profile',function(){
     $id = Session::get('role');
    if ($id != 'admin'){
        $menu = DB::select("select induk,kode_menu,nama_menu,route FROM `adm_menu`,`adm_role_menu`,`adm_role` WHERE `adm_menu`.`id`=`adm_role_menu`.`menu_id` AND `adm_role`.`id`=`adm_role_menu`.`role_id` and adm_role.nama_role = '$id'");
        }
    else{
        $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
        } 
    $data = User::where('uuid', Session::get('uuid'))->first();
        return view('page.user.profile',compact('menu','data'));
    
    });
    Route::get('/', function () {
    $id = Session::get('role');
    if ($id != 'admin'){
        $menu = DB::select("select induk,kode_menu,nama_menu,route FROM `adm_menu`,`adm_role_menu`,`adm_role` WHERE `adm_menu`.`id`=`adm_role_menu`.`menu_id` AND `adm_role`.`id`=`adm_role_menu`.`role_id` and adm_role.nama_role = '$id'");
        return view('layout.master',compact('menu'));
        }
    else{
        $menu = adm_menu::select('induk','kode_menu','nama_menu','route')->orderBy('kode_menu','asc')->get();
        return view('layout.master',compact('menu'));
        }
    });
    Route::put('/ubah/{id}', [AdmUserController::class, 'updateUser'])->name('updateUser');
    Route::put('/password/{id}', [AdmUserController::class, 'updatePassword'])->name('updatePassword');
    Route::put('/photo/{id}', [AdmUserController::class, 'updatePhoto'])->name('updatePhoto');
    Route::middleware('role:admin')->group(function () {
    Route::resource('adm-menu', AdmMenuController::class)->except(['create','show']);
    Route::resource('adm-role', Adm_roleController::class)->except(['create','show']);
    Route::resource('adm-role-menu', AdmRoleMenu::class)->only(['index','store']);
    Route::resource('adm-user', AdmUserController::class);
    });

    // Route::get('/profile', function () {
    //     return view('page.user.profile');
    // });
    

   
});