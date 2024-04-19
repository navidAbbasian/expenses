<?php

use App\Http\Controllers\auth\LoginUserController;
use App\Http\Controllers\auth\RegisterUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

    Route::get('/user', [UserController::class, 'show']);

    Route::prefix( 'transactions')->controller( TransactionController::class)->group(function () {
        Route::post( '',  'store');
        Route::get( '',  'index');
        Route::get( '/{transaction}', 'show');
        Route::put( '/{transaction}',  'update');
        Route::delete( '/{transaction}',  'delete');
    });

    Route::prefix( 'banks')->controller( BankController::class)->group(function () {
        Route::post( '',  'store');
        Route::get( '',  'index');
        Route::get( '/{bank}', 'show');
        Route::put( '/{bank}',  'update');
        Route::delete( '/{bank}',  'delete');
    });

    Route::prefix( 'tags')->controller( TagController::class)->group(function () {
        Route::post( '',  'store');
        Route::get( '',  'index');
        Route::get( '/{tag}', 'show');
        Route::put( '/{tag}',  'update');
        Route::delete( '/{tag}',  'delete');
    });

});
