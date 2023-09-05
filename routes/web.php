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
use App\Http\Controllers\Sub2AkunController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanSiswaController;
use App\Http\Controllers\TagihanTingkatController;
use App\Http\Controllers\NonTagihanController;
use App\Http\Controllers\TransaksiSiswaController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;

use App\Models\adm_menu;
use App\Models\adm_role;
use App\Models\Siswa;
use App\Models\User;
use App\Models\TransaksiHead;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Carbon;




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
        $transaksi = TransaksiHead::select( DB::raw('sum(masuk) as pemasukan ,sum(keluar) as pengeluaran'))->whereBetween('tanggal', [now()->startOfMonth(), now()->endOfMonth()])->first();
        $pengeluaran = TransaksiHead:: select( DB::raw('sum(keluar) as pengeluaran'))->whereBetween('tanggal', [now()->startOfYear(), now()->endOfYear()])->groupBy(DB::raw('MONTH(tanggal)'))->orderBy(DB::raw('MONTH(tanggal)'),'asc')->get();
        $pemasukan = TransaksiHead:: select( DB::raw('sum(masuk) as pemasukan'))->whereBetween('tanggal', [now()->startOfYear(), now()->endOfYear()])->groupBy(DB::raw('MONTH(tanggal)'))->orderBy(DB::raw('MONTH(tanggal)'),'asc')->get();
        $pengeluaranTahun = TransaksiHead:: select( DB::raw('sum(keluar) as pengeluaran'))->whereBetween('tanggal', [now()->startOfYear(), now()->endOfYear()])->first();
        $pemasukanTahun = TransaksiHead:: select( DB::raw('sum(masuk) as pemasukan'))->whereBetween('tanggal', [now()->startOfYear(), now()->endOfYear()])->first();
        $bulan = TransaksiHead::select(  DB::raw('MONTHNAME(tanggal) as bulan'))->distinct()->orderBy(DB::raw('MONTH(tanggal)'),'asc')->get();
        $keluar =  collect($pengeluaran)->pluck('pengeluaran')->toArray();
        $bulan = collect($bulan)->pluck('bulan')->toArray();
        $masuk =  collect($pemasukan)->pluck('pemasukan')->toArray();
       ;
        return view('page.dashboard',compact(['menu','siswa','transaksi','pemasukanTahun','pengeluaranTahun','keluar','masuk','bulan']));
        
        // return $chart;
    });
    Route::delete('hapus/{id}',[LaporanController::class ,'hapusHead'])->name('hapusHead');
    Route::get('laporan_penerimaan',[LaporanController::class ,'penerimaan']);
    Route::get('history_pembayaran_siswa',[LaporanController::class ,'pembayaranSiswa']);
    Route::get('rekap_penerimaan_kelas',[LaporanController::class ,'penerimaanKelas']);
    Route::get('summary_tagihan',[LaporanController::class ,'summaryTagihan']);
    Route::get('laporan_jurnal',[LaporanController::class ,'jurnal']);
    Route::post('laporan_penerimaan',[LaporanController::class ,'penerimaan'])->name('penerimaan');
    Route::post('history_pembayaran_siswa',[LaporanController::class ,'pembayaranSiswa'])->name('pembayaranSiswa');
    Route::post('rekap_penerimaan_kelas',[LaporanController::class ,'penerimaanKelas'])->name('penerimaanKelas');
    Route::post('summary_tagihan',[LaporanController::class ,'summaryTagihan'])->name('summary');
    Route::post('laporan_jurnal',[LaporanController::class ,'jurnal'])->name('jurnal');
    Route::resource('non_tagihan',NonTagihanController::class)->except(['create','edit']);
    Route::resource('transaksi_siswa',TransaksiSiswaController::class);
    Route::resource('penerimaan', PenerimaanController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::post('transaksi_detail_siswa', [TransaksiSiswaController::class ,'transaksiDetail'])->name('transaksiDetail');
    Route::get('generate_tagihan_siswa', [TagihanSiswaController::class ,'generate'])->name('generate');
    Route::resource('sub_sub_akun', Sub2AkunController::class)->except(['create','edit']);
    Route::resource('tingkat', MasterTingkaCntrl::class)->except(['create','edit']);
    Route::resource('akun', AkunController::class)->except(['create','edit']);
    Route::resource('tagihan', TagihanController::class)->except(['create','edit']);
    Route::resource('tagihan_siswa', TagihanSiswaController::class)->except(['create','edit']);
    Route::resource('tagihan_tingkat', TagihanTingkatController::class)->except(['create','edit']);
    Route::resource('non_tagihan', NonTagihanController::class)->except(['create','edit']);
    Route::resource('unit', MasterUnitCntrl::class)->except(['create','edit']);
    Route::resource('akun_head',AkunHeadController::class)->except(['create','edit']);
    Route::resource('akun_head_sub',AkunHeadSubController::class)->except(['create','edit']);
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

