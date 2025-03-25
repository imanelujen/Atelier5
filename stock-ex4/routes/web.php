<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [StockController::class ,'index']);
Route::post('/stocks', [StockController::class ,'store']);
Route::put('/stocks/{id}', [StockController::class ,'update']);
Route::delete('/stocks/{id}', [StockController::class ,'destroy']);
