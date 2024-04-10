<?php

use App\Http\Controllers\auth\LoginUserController;
use App\Http\Controllers\auth\RegisterUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TransactionController;
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

Route::post('register', [RegisterUserController::class, 'store']);
Route::post('login', [LoginUserController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {

//    Route::prefix(prefix: 'transactions')->controller(controller: TransactionController::class)->group(function () {
//        Route::post(uri: '', action: 'store');
//        Route::get(uri: '', action: 'index');
//        Route::get(uri: '/{transaction}', action: 'show');
//        Route::put(uri: '/{transaction}', action: 'update');
//        Route::delete(uri: '/{transaction}', action: 'delete');
//    });

    Route::post(uri: 'transactions', action: [TransactionController::class, 'store']);
    Route::get(uri: 'transactions', action: [TransactionController::class, 'index']);
    Route::get(uri: 'transactions/{transaction}', action: [TransactionController::class, 'show']);
    Route::put(uri: 'transactions/{transaction}', action: [TransactionController::class, 'update']);
    Route::delete(uri: 'transactions/{transaction}', action: [TransactionController::class, 'delete']);

    Route::post(uri: 'banks', action: [BankController::class, 'store']);
    Route::get(uri: 'banks', action: [BankController::class, 'index']);
    Route::get(uri: 'banks/{bank}', action: [BankController::class, 'show']);
    Route::put(uri: 'banks/{bank}', action: [BankController::class, 'update']);
    Route::delete(uri: 'banks/{bank}', action: [BankController::class, 'delete']);
});
