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

use App\Http\Controllers\KelasController;
use App\Jadwal;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    ]);

    Route::group(['middleware'=>['auth','checkrole:admin']],function(){    
    
        route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
        route::post('/siswa/{id}/updatenilai','SiswaController@updatenilai');
        // route::post('/siswa/{id}/konfirm','SiswaController@konfirm')->name('konfirm');
        route::delete('/siswa/{id}/{idmapel}/deletenilai','SiswaController@deletenilai');
        
        route::resource('/kelas','KelasController');
        route::resource('/guru','GuruController');
        route::get('/mapel','MapelController@index')->name('mapel.index');
        route::post('/mapel/store','MapelController@store')->name('mapel.store');
        route::put('/mapel/{id}','MapelController@update')->name('mapel.update');

    });
    // admin
Route::group(['middleware'=>['auth','checkrole:admin,guru']],function(){

    route::get('/siswa','SiswaController@index')->name('siswa.index');
    route::post('/siswa/store','SiswaController@store')->name('siswa.store');
    route::put('siswa/{id}','SiswaController@update')->name('siswa.update');
    route::delete('siswa/{id}','SiswaController@destroy')->name('siswa.destroy');
    route::get('/siswa/{id}/profile','SiswaController@profile')->name('siswa.profile');
    route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
    route::post('/siswa/{id}/updatenilai','SiswaController@updatenilai');
    route::delete('/siswa/{id}/{idmapel}/deletenilai','SiswaController@deletenilai');
    route::resource('/pengumuman','PengumumanController');
   

    

});

// cetak
Route::group(['middleware'=>'auth','checkrole:admin,siswa'],function(){
    route::get('/siswa/{id}/cetak_rapor_pdf','SiswaController@cetak_rapor_pdf')->name('siswa.cetak_rapor_pdf');
});

// siswa
Route::group(['middleware'=>['auth','checkrole:siswa']],function(){
    route::get('/profil','SiswaController@profilsaya')->name('profilsaya');

});
// guru
Route::group(['middleware'=>['auth','checkrole:guru']],function(){
    route::get('/profil/guru','GuruController@profilguru')->name('profilguru');
    route::post('/siswa/{id}/konfirm','SiswaController@konfirm')->name('konfirm');
});

// dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



//jadwal
Route::group(['middleware'=>['auth','checkrole:guru,admin,siswa']],function(){
    route::resource('/jadwal','JadwalController');
});

// changepassword
Route::get('change-password', 'ChangePasswordController@index')->name('changepassword');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

