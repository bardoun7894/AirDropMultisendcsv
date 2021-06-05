<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('add-address-crypto', [\App\Http\Controllers\HomeController::class,'addCryptoAddress']);
Route::post('add-airdrop', [\App\Http\Controllers\HomeController::class,'makeRandomAddress']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
