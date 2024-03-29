<?php

use App\Http\Controllers\TransactionController;
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

Route::post(uri: 'transactions',action: [TransactionController::class, 'store']);
Route::get(uri: 'transactions',action: [TransactionController::class, 'index']);
Route::get(uri:'transactions/{transaction}',action: [TransactionController::class, 'show']);
Route::put(uri:'transactions/{transaction}',action: [TransactionController::class, 'update']);
Route::delete(uri: 'transactions/{transaction}',action: [TransactionController::class, 'delete']);
