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

Route::get('/', function(){
    return view('admin.dashboard');
})->middleware('auth');

Route::post('/api/init', [App\Http\Controllers\Auth\LoginController::class, 'init'])->name('home.init')->middleware('web');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('lang/{lang}', [App\Http\Controllers\LanguageController::class, 'swap'])->name('lang.swap')->middleware('auth');
Route::get('swapcountry/{lang}', [App\Http\Controllers\LanguageController::class, 'swapcountry'])->name('lang.swapcountry')->middleware('auth');

Route::get('/notAuthenticated', [App\Http\Controllers\HomeController::class, 'notAuthenticated'])->name('notAuthenticated');


