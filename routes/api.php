<?php

use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/reload',[WalletController::class, 'reload']);
Route::post('/pay',[WalletController::class, 'pay']);
Route::post('/valtoken',[WalletController::class, 'valtoken']);
Route::post('/saldo',[WalletController::class, 'saldo']);
Route::get('/historyshop',[WalletController::class,'historyshop']);
Route::get('/historyreload',[WalletController::class, 'historyreload']);

