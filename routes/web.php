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

Route::redirect('/', '/login');

//LOGIN LOGOUT
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'ceklevel:admin,kepsek,guru,siswa']], function(){
      Route::get('/dashboards', 'DashboardController@index')->name('dashboards.index');
});

Route::group(['middleware' => ['auth', 'ceklevel:admin,kepsek']], function(){
      //Admin
      Route::resource('/admin', 'AdminController');

      //Kepsek
      Route::resource('/kepsek', 'KepalaSekolahController');

      //Siswa
      Route::resource('/siswa', 'SiswaController');

      //Kelas
      Route::resource('/kelas', 'KelasController');

      //Guru
      Route::resource('/guru', 'GuruController');
      Route::get('/guru/{guru}/profile', 'GuruController@profile')->name('profil_guru');

      //Mata Pelajaran
      Route::resource('/mapel', 'MapelController');

      //Pengumuman
      Route::resource('/pengumuman', 'PengumumanController');

      //TAHUN AJARAN
      Route::get('/tahun_ajaran', 'TahunAjaranController@index')->name('tahun_ajaran.index');
      Route::post('/tahun_ajaran', 'TahunAjaranController@input')->name('tahun_ajaran.input');
      Route::delete('/tahun_ajaran/{id}', 'TahunAjaranController@hapus')->name('tahun_ajaran.hapus');
});

Route::group(['middleware' => ['auth', 'ceklevel:guru']], function(){
      // Route::get('/daftar_mata_pelajaran', 'MapelController@daftar_mapel')->name('mapel_guru');
      Route::get('/guru/{guru}/biodata', 'GuruController@biodata_guru')->name('biodata_guru');
      //Materi
      Route::resource('/materi', 'MateriController');

      //Agenda
      Route::resource('/agenda', 'AgendaController');
});

Route::group(['middleware' => ['auth', 'ceklevel:siswa']], function(){
    Route::get('/mymapel', 'MapelController@halaman_mapel_siswa')->name('halaman_mapel_siswa');
    Route::get('/mymapel/{id}/materi', 'MapelController@show_materi_siswa')->name('show_materi_siswa');
    //Agenda siswa
    Route::get('/agenda_siswa', 'AgendaController@index_siswa')->name('agenda_siswa');
    Route::get('/agenda_siswa/{id}/show', 'AgendaController@show_siswa')->name('agenda_siswa_show');
});


Route::get('/home', 'HomeController@index')->name('home');