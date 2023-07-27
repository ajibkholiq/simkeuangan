<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\adm_menu;



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
