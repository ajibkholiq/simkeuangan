<?php

use App\Models\AkunHead;
use App\Models\NonTagihan;
use App\Models\Sub2Akun;
use App\Models\Akun;
use App\Models\Tagihan;
use App\Models\AkunHeadSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\adm_menu;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\pelajaran;
use App\Models\SMSTR;
use App\Models\MasterTingkat;
use App\Models\MasterUnit;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/menu/{id}',function ($id){
        $data = adm_menu::where('uuid','=',$id)->first();
        return response()->json( $data, 200);
});
Route::get('getprovinsi', function (){
    return response()->json(DB::table('provinsi')->get() , 200,);
});
Route::get('getkabupaten/{id}', function ($id){
    return response()->json(DB::table('kabupaten')->select('kabupaten.name')->join('provinsi','provinsi_id','provinsi.id')->where('provinsi.name',str_replace('%20',' ' ,$id))->get() , 200,);
});
Route::get('getkecamatan/{id}', function ($id){
    return response()->json(DB::table('kecamatan')->select('kecamatan.name')->join('kabupaten','kabupaten_id','kabupaten.id')->where('kabupaten.name',str_replace('%20',' ' ,$id))->get() , 200,);
});
Route::get('getkelurahan/{id}', function ($id){
    return response()->json(DB::table('kelurahan')->select('kelurahan.name')->join('kecamatan','kecamatan_id','kecamatan.id')->where('kecamatan.name',str_replace('%20',' ' ,$id))->get() , 200,);
});
Route::get('getSiswa', function(){return ['data' => Siswa::join('kelas','id_kelas','kelas.id')->select('siswa.uuid','nis','nama','kelas.kelas','alamat_detail',
            'provinsi','kabupaten','kecamatan','kelurahan','nama_ayah','nama_ibu','no_hp','siswa.remark',)->get()];});
Route::get('tingkat', function(){return ['data' => MasterTingkat::all()];});
Route::get('unit', function(){return ['data' => MasterUnit::all()];});
Route::get('thn-ajar', function(){return ['data' => pelajaran::all()];});
Route::get('semester', function(){return ['data' => SMSTR::all()];});
Route::get('pegawai', function(){return ['data' => User::all()];});
Route::get('kelas', function(){
    return ['data' => kelas::join('master_tingkat','tingkat_id','master_tingkat.id')
                    ->join('master_unit','unit_id','master_unit.id')
                    ->join('users','user_id','users.id')
                    ->select('kelas.id','kelas.uuid','kelas','kode_kelas','nama_tingkat','nama_unit', 'kelas.remark','users.nama')->get()];
});

Route::get('akun_head', function(){
    return ['data' => AkunHead::all()];
});
Route::get('akun_head_sub', function(){
    return ['data' => AkunHeadSub::join ('akun_head','akun_head_id','akun_head.id')->select('master_akun_head_sub.uuid','akun_head_sub','akun_head','master_akun_head_sub.urut','master_akun_head_sub.remark')->get()];
});
Route::get('akun_head_sub2', function(){
    return ['data' => Sub2Akun::join('master_akun_head_sub','sub_akun_id','master_akun_head_sub.id')->join('akun_head','akun_head_id','akun_head.id')->select('sub2_akuns.uuid','Nama','akun_head_sub','akun_head','sub2_akuns.urut','sub2_akuns.remark')->get()];
});
Route::get('akun', function(){
    return ['data' => Akun::join('sub2_akuns','sub2_akun_id','sub2_akuns.id')
                            ->join('master_akun_head_sub','sub_akun_id','master_akun_head_sub.id')
                            ->join('akun_head','akun_head_id','akun_head.id')
                            ->select('kode','akuns.uuid','akuns.Nama as akun','akun_head_sub','akun_head','sub2_akuns.Nama','akuns.remark')
                            ->get()];
});
Route::get('tagihan', function(){
    return ['data' => Tagihan::join('tahun_pelajaran','tahun_pelajaran.id','thn_ajaran_id')
                                ->join('akuns','akuns.id','akun_id')
                                ->select('tagihans.uuid','tahun_pelajaran','tagihans.kode','tagihans.nama','akuns.Nama','batas_bayar','tagihans.remark')
                                ->get()];
});

Route::get('non_tagihan', function(){
    return ['data' => NonTagihan::all()];
});

