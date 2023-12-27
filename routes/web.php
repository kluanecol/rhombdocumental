<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::get('/notAuthenticated', [App\Http\Controllers\HomeController::class, 'notAuthenticated'])->name('notAuthenticated');


Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', function(){

        return view('admin.dashboard');

    })->name('dashboard');

    Route::get('/get/info/{id}', [App\Http\Controllers\HomeController::class, 'getInfo'])->name('getInfo');

    Route::post('/get/info', [App\Http\Controllers\HomeController::class, 'getInfoPost'])->name('getInfoPost');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


