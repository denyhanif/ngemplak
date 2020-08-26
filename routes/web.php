<?php

use App\Http\Controllers\WargaController;
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
    return view('warga.login');
});

Auth::routes([
    'register' => false, 
    'reset' => false, 
    'verify' => false, 
  ]);

Route::group(['prefix' => 'Administrator', 'middleware' => 'auth'], function () {
    Route::resource('home', 'HomeController');
    Route::resource('kategori', 'kategoriSuratController');
    Route::get('kategori/data/{id}','kategoriSuratController@data')->name('kategori.data');//  m
    Route::resource('pengajuan', 'dataPengajuanController');
    Route::get('/riwayat', 'HomeController@riwayat')->name('riwayat.pengajuan');
    Route::get('/list-kategori/{id}', 'HomeController@listkategori')->name('list.kategori');
    Route::get('/list-pegawai', 'HomeController@admin')->name('admin.index');
    Route::post('/verifikasi', 'HomeController@verifikasi')->name('send.verifikasi');
    Route::get('/print/{id}', 'HomeController@print')->name('print.surat');
    Route::get('/jadi/{id}', 'HomeController@emailjadi')->name('send.jadi');
    Route::get('/register', 'HomeController@register')->name('admin.register');
    Route::post('/store', 'HomeController@registerstore')->name('register.store');
    Route::get('/admin/{id}', 'HomeController@editadmin')->name('admin.edit');
    Route::put('/admin/update/{id}', 'HomeController@adminupdate')->name('admin.update');
    Route::delete('/admin/{id}', 'HomeController@destroyadmin')->name('admin.destroy');
});

Route::group(['prefix' => 'member', 'namespace' => 'Warga'], function() {
    Route::get('/warga', 'LoginController@loginForm')->name('warga.login');
    Route::get('/registrasi', 'LoginController@registrasiForm')->name('warga.register');
    Route::post('/registrasi', 'LoginController@registrasistore')->name('registrasi.store');
    Route::post('/login', 'LoginController@login')->name('login.proses');


    Route::group(['middleware' => 'warga'], function () {
        Route::get('dashboard', 'WargaController@dashboard')->name('warga.dashboard');
        Route::get('logout', 'WargaController@logout')->name('warga.logout');
        Route::post('pengajuan', 'WargaController@pengajuanstore')->name('warga.pengajuan.store');
        Route::get('riwayat', 'WargaController@riwayat')->name('warga.riwayat');
    });
});