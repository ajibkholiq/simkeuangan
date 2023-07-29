<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\adm_menu;
use App\Models\Siswa;
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
Route::get('getSiswa', function(){
    return ['data' => Siswa::all()];
});

