<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
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
//Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () {
       // dd(\DB::connection('rhomb')->table('users')->select('id')->get());
        dd(User::find(1));
        Auth::loginUsingId(1);

        dd(Auth::user());
        return view('welcome');

    });

    Route::get('/init', function () {

        Auth::loginUsingId(1);

        dd(Auth::user());
        return view('welcome');

    })->middleware('auth.basic');
//});

