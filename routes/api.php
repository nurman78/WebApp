<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/mahasiswa',[MahasiswaController::class,'index']);
Route::post('/create',[MahasiswaController::class,'store']);
Route::get('/show/{id}',[MahasiswaController::class,'show']);
Route::get('/delete/{id}',[MahasiswaController::class,'delete']);
Route::post('/update/{id}',[MahasiswaController::class,'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
