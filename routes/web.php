<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/dashboards/pengumuman/show/{id}', 'DashboardController@show')->name('dashboards.show');
});

//Admin, Kepsek
Route::group(['middleware' => ['auth', 'ceklevel:admin,kepsek']], function(){
    //Admin
    Route::resource('/admin', 'AdminController');

    //Kepsek
    Route::resource('/kepsek', 'KepalaSekolahController');

    //Siswa
    Route::resource('/siswa', 'SiswaController');
    Route::get('/siswa/{siswa}/profile', 'SiswaController@profile')->name('profil_siswa');

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

//Guru
Route::group(['middleware' => ['auth', 'ceklevel:guru']], function(){
    // Route::get('/daftar_mata_pelajaran', 'MapelController@daftar_mapel')->name('mapel_guru');
    Route::get('/biodata/{guru}', 'GuruController@biodata_guru')->name('biodata_guru');
    Route::get('/biodata/{guru}/edit_biodata', 'GuruController@edit_biodata_gurus')->name('guru.edit_biodata_gurus');
    Route::patch('/biodata/{guru}/update', 'GuruController@update_biodata_gurus')->name('guru.update_biodata_gurus');

    //Materi
    Route::resource('/materi', 'MateriController');

    //Agenda
    Route::resource('/agenda', 'AgendaController');

    //Tugas
    Route::resource('/tugas_siswa', 'TugasSiswaController');

    //Lihat Tugas Siswa Yang Terkumpul
    Route::get('/tugas_siswa/{id}/lihat_tugas_siswa', [
        'as' => 'lihat_tugas_siswa',
        'uses' => 'TugasSiswaController@show_kumpul_tugas_siswa'
    ]);

});

//Siswa
Route::group(['middleware' => ['auth', 'ceklevel:siswa']], function(){
    Route::get('/biodatasiswa/{siswa}', 'SiswaController@biodata_siswas')->name('biodata_siswa');
    Route::get('/biodatasiswa/{siswa}/edit_biodata', 'SiswaController@edit_biodata_siswas')->name('siswa.edit_biodata_siswas');
    Route::patch('/biodatasiswa/{siswa}/update', 'SiswaController@update_biodata_siswas')->name('siswa.update_biodata_siswas');

    Route::get('/mymapel', 'MapelController@halaman_mapel_siswa')->name('halaman_mapel_siswa');

    //list mapel sesuai kelas berdasarkan siswa yang login
    Route::get('/mapelsaya', 'MapelController@list_mapel_siswa')->name('list_mapel_siswa');

    //materi siswa sesuai mapel
    Route::get('/mapelsaya/materi/{id}', 'MateriController@halaman_materi_siswa')->name('halaman_materi_siswa');
    Route::get('/mapelsaya/materi/{id}/show', 'MateriController@show_materi_siswa')->name('show_materi_siswa');

    //tugas siswa sesuai mapel
    Route::get('/mapelsaya/tugas-siswa/{id}', 'TugasSiswaController@halaman_tugas_siswa')->name('halaman_tugas_siswa');
    Route::get('/mapelsaya/tugas-siswa/{id}/show', 'TugasSiswaController@show_tugas_siswa')->name('show_tugas_siswa');
    Route::post('/mapelsaya/tugas-siswa/{id}/proses', [
        'as' => 'upload_tugas',
        'uses' => 'TugasSiswaController@kumpul_tugas_siswa'
    ]);


    //Agenda siswa
    Route::get('/agenda_siswa', 'AgendaController@index_siswa')->name('agenda_siswa');
    Route::get('/agenda_siswa/{id}/show', 'AgendaController@show_siswa')->name('agenda_siswa_show');
});

Route::get('/home', 'HomeController@index')->name('home');
