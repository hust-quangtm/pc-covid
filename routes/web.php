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
Auth::routes();

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
    Route::get('getLocation', 'App\Http\Controllers\ProfileController@getLocation')->name('ajax_get.location');
    Route::post('/store-token', 'App\Http\Controllers\WebNotificationController@storeToken')->name('store.token');
    Route::get('/mtg','App\Http\Controllers\ZoomController@index');

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

    Route::group(['prefix' => 'health-track'], function() {
        Route::get('/', 'App\Http\Controllers\HealthTrackController@index')->name('health-track.index');
        Route::get('/create', 'App\Http\Controllers\HealthTrackController@create')->name('health-track.create');
        Route::post('/create', 'App\Http\Controllers\HealthTrackController@store')->name('health-track.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\HealthTrackController@edit')->name('health-track.edit');
        Route::post('/update/{id}', 'App\Http\Controllers\HealthTrackController@update')->name('health-track.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\HealthTrackController@destroy')->name('health-track.delete');
    });

    Route::group(['prefix' => 'check-patient'], function() {
        Route::get('/', 'App\Http\Controllers\PatientInformationController@index')->name('check-patient.index');
        Route::get('/show/{id}', 'App\Http\Controllers\PatientInformationController@show')->name('check-patient.show');
        Route::get('/create', 'App\Http\Controllers\PatientInformationController@create')->name('check-patient.create');
        Route::post('/create', 'App\Http\Controllers\PatientInformationController@store')->name('check-patient.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\PatientInformationController@edit')->name('check-patient.edit');
        Route::post('/update/{id}', 'App\Http\Controllers\PatientInformationController@update')->name('check-patient.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\PatientInformationController@destroy')->name('check-patient.delete');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin|ward|district|province']], function () {
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.index');
    Route::get('/user', 'App\Http\Controllers\AdminController@indexUser')->name('admin.index.user');
    Route::get('/delete/{id}', 'App\Http\Controllers\AdminController@deleteUser')->name('admin.delete.user');
    Route::get('/tiem-chung', 'App\Http\Controllers\Admin\InjectionController@index')->name('admin.tiemchung.index');
    Route::get('/tiem-chung/edit/{id}', 'App\Http\Controllers\Admin\InjectionController@edit')->name('admin.tiemchung.edit');
    Route::post('/tiem-chung/update/{id}', 'App\Http\Controllers\Admin\InjectionController@update')->name('admin.tiemchung.update');
    Route::get('/push-notificaiton', 'App\Http\Controllers\WebNotificationController@index')->name('push-notification');
    Route::post('/send-web-notification', 'App\Http\Controllers\WebNotificationController@sendWebNotification')->name('send.web-notification');

    Route::group(['prefix' => 'check-patient'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\PatientInformationController@index')->name('admin.check-patient.index');
        Route::get('/show/{id}', 'App\Http\Controllers\Admin\PatientInformationController@show')->name('admin.check-patient.show');
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\PatientInformationController@edit')->name('admin.check-patient.edit');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\PatientInformationController@update')->name('admin.check-patient.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\PatientInformationController@destroy')->name('admin.check-patient.delete');
    });

    Route::group(['prefix' => 'health-track'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\HealthTrackController@index')->name('admin.health-track.index');
        Route::get('/{user_id}/detail', 'App\Http\Controllers\Admin\HealthTrackController@detail')->name('admin.health-track.detail');
        Route::get('/show/{id}', 'App\Http\Controllers\Admin\HealthTrackController@show')->name('admin.health-track.show');
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\HealthTrackController@edit')->name('admin.health-track.edit');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\HealthTrackController@update')->name('admin.health-track.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\HealthTrackController@destroy')->name('admin.health-track.delete');
    });
});
