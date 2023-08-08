<?php

use App\Http\Controllers\AkunHeadController;
use App\Http\Controllers\AkunHeadSubController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmMenuController;
use App\Http\Controllers\AdmRoleMenu;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Adm_RoleController;
use App\Http\Controllers\AdmUserController;
use App\Http\Controllers\ThnPljrnController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MasterTingkaCntrl;
use App\Http\Controllers\MasterUnitCntrl;
use App\Models\adm_menu;
use App\Models\adm_role;
use App\Models\Siswa;
use App\Models\User;
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

Route::get('/', [loginController::class , 'index' ])->name('login');
Route::get('/logout', [loginController::class , 'logout' ])->name('logout');
Route::post('/validate', [loginController::class , 'validasi' ])->name('validate');
Route::middleware('checklogin')->group(function () {
    Route::get('/profile',function(){
        $menu = menu::getMenu(Session::get('role'));
        $data = User::where('uuid', Session::get('uuid'))->first();
        return view('page.user.profile',compact('menu','data'));
    });
    Route::get('/welcome', function () {
        $menu = menu::getMenu(Session::get('role'));
        return view('page.home',compact('menu'));
    });
    Route::get('/dashboard', function(){ 
        $menu = menu::getMenu(Session::get('role'));
        $siswa = count(Siswa::all());
        return view('page.dashboard',compact(['menu','siswa']));
        // return $siswa;
    });
    Route::resource('tingkat', MasterTingkaCntrl::class);
    Route::resource('unit', MasterUnitCntrl::class);

    Route::resource('akun_head',AkunHeadController::class);
    Route::resource('akun_head_sub',AkunHeadSubController::class);
    Route::resource('tahun_pelajaran', thnPljrnController::class)->except(['show','create','edit']);
    Route::resource('siswa', SiswaController::class)->except(['create','edit']);
    Route::resource('kelas', KelasController::class)->except(['create','edit']);
    Route::resource('semester', SemesterController::class)->except(['show','create','edit']);
    Route::put('/ubah/{id}', [AdmUserController::class, 'updateUser'])->name('updateUser');
    Route::put('/password/{id}', [AdmUserController::class, 'updatePassword'])->name('updatePassword');
    Route::put('/photo/{id}', [AdmUserController::class, 'updatePhoto'])->name('updatePhoto');
    Route::middleware('role:admin')->group(function () {
        Route::resource('adm-menu', AdmMenuController::class)->except(['create','show']);
        Route::resource('adm-role', Adm_roleController::class)->except(['create','edit']);
        Route::resource('adm-role-menu', AdmRoleMenu::class)->only(['index','store']);
        Route::resource('pegawai', AdmUserController::class);
    });
});

