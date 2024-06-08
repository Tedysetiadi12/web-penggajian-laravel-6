<?php

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

// Public routes
Route::middleware('guest')->group(function () {
Route::get('/', 'AuthController@login')->name('login');
Route::post('/ceklogin', 'AuthController@Ceklogin');
Route::get('register', 'AuthController@showRegisterForm')->name('register');
Route::post('register', 'AuthController@register');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/ubahpassword', 'AuthController@ubahpassword');
    Route::get('/home', 'mainController@home');
    Route::get('/laporangaji', 'mainController@laporangaji');
    Route::get('/pegawai', 'pageController@pegawai');
    Route::get('/jabatan', 'pageController@jabatan');
    Route::get('/penggajian', 'pageController@penggajian');

    // CRUD Jabatan
    Route::get('/deljabatan/{id}', 'deleteController@delJabatan');
    Route::post('/updatejab/{id}', 'updateController@updatejab');
    Route::post('/createJabatan', 'createController@createJabatan');

    Route::delete('/deletepegawai/{id}', 'deleteController@deletepegawai');
    Route::put('/updatepegawai/{id}', 'updateController@updatepeg');
    Route::post('/createpegawai', 'createController@tambahpegawai');

    Route::delete('/deletepenggajian/{id}', 'deleteController@deletepenggajian');
    Route::post('/createpenggajian', 'createController@tambahgaji');
    Route::put('/updatepenggajian/{id}', 'updateController@updategaji');

    Route::get('/tambahjabatan', 'createController@tampil')->name('tambahjabatan');
});
