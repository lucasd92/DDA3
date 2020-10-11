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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/disp_aceptados','App\Http\Controllers\DispAcCtrl')->middleware('auth');
Route::resource('/disp_no_aceptados','App\Http\Controllers\DispNoAcCtrl')->middleware('auth');
Route::resource('/log_disp','App\Http\Controllers\LogCtrl')->middleware('auth');