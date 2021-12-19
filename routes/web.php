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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
	Route::put('profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons');
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    Route::group(['prefix' => 'khao-bao-y-te'], function () {
        Route::get('/', 'App\Http\Controllers\UserController@index')->name('index.khai-bao');
        Route::get('/create', 'App\Http\Controllers\UserController@khaibao')->name('create.khai-bao');
        Route::post('/store', 'App\Http\Controllers\UserController@storeKhaiBao')->name('store.khai-bao');
        Route::get('/edit/{id}', 'App\Http\Controllers\UserController@editKhaiBao')->name('edit.to-khai');
        Route::post('/update/{id}', 'App\Http\Controllers\UserController@updateKhaiBao')->name('update.to-khai');
        Route::get('/delete/{id}', 'App\Http\Controllers\UserController@deleteKhaiBao')->name('delete.to-khai');
    });

    Route::group(['prefix' => 'tiem-chung'], function() {
        Route::get('/', 'App\Http\Controllers\UserController@indexTiemChung')->name('index.tiem-chung');
        Route::get('/create', 'App\Http\Controllers\UserController@createTiemChung')->name('create.tiem-chung');
        Route::post('/create', 'App\Http\Controllers\UserController@storeTiemChung')->name('store.tiem-chung');
        Route::get('/edit/{id}', 'App\Http\Controllers\UserController@editTiemChung')->name('edit.tiem-chung');
        Route::post('/update/{id}', 'App\Http\Controllers\UserController@updateTiemChung')->name('update.tiem-chung');
        Route::get('/delete/{id}', 'App\Http\Controllers\UserController@deleteTiemChung')->name('delete.tiem-chung');
    });
});

