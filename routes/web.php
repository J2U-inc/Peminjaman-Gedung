<?php

use App\Lembaga;
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

Route::get('/', function () {
    return view('welcomee');
});

Auth::routes();

//admin
// Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('admin/index', 'AdminController@index')->name('admin.index')->middleware('is_admin'); //login admin

//Gedung
Route::get('/admin/gedung', 'GedungController@index')->middleware('is_admin');
Route::get('/admin/gedung/create', 'GedungController@create')->middleware('is_admin'); //tambah gedung
Route::post('/admin/gedung', 'GedungController@store')->middleware('is_admin'); //tampilkan gedung
Route::get('/admin/gedung/{id}', 'GedungController@show')->middleware('is_admin'); //detail gedung
Route::get('/admin/gedung/{id}/edit', 'GedungController@edit')->middleware('is_admin'); //masuk ke view edit
Route::put('/admin/gedung/{id}', 'GedungController@update')->middleware('is_admin'); // update data
Route::delete('/admin/gedung/{id}', 'GedungController@destroy')->middleware('is_admin'); //hapus data

//Lembaga
// Route::get('/admin/lembaga' , 'LembagaController@index')->middleware('is_admin');
// Route::get('admin/lembaga/create' , 'LembagaController@create')->middleware('is_admin');
// Route::post('admin/lembaga' , 'LembagaController@store')->middleware('is_admin');
// Route::get('/admin/lembaga/{id}' , 'LembagaController@show')->middleware('is_admin');
// Route::get('/admin/lembaga/{id}/edit', 'LembagaController@edit')->middleware('is_admin');
// Route::put('/admin/lembaga/{id}', 'LembagaController@update')->middleware('is_admin');
// Route::delete('/admin/lembaga/{id}', 'LembagaController@destroy')->middleware('is_admin');

//data peminjaman admin
Route::get('/admin/peminjaman' , 'PeminjamanController@index')->name('peminjaman');
Route::get('admin/peminjaman/create' , 'PeminjamanController@create'); //ke view tambah data
Route::post('admin/peminjaman' , 'PeminjamanController@store')->name('peminjaman.store'); // tambah data
Route::get('/admin/peminjaman/{id}' , 'PeminjamanController@show')->name('peminjaman.show');
Route::get('/admin/peminjaman/{id}/edit', 'PeminjamanController@edit')->middleware('is_admin');
Route::put('/admin/peminjaman/{id}', 'PeminjamanController@update')->middleware('is_admin')->name('peminjaman.update');
Route::delete('/admin/peminjaman/{id}', 'PeminjamanController@destroy')->middleware('is_admin');
Route::put('/admin/persetujuan/{id}', 'PeminjamanController@persetujuan')->middleware('is_admin');
Route::put('/admin/penolakan/{id}', 'PeminjamanController@penolakan')->middleware('is_admin');
Route::get('/admin/lihatriwayat/{id}' , 'PeminjamanController@lihatriwayat')->name('peminjaman.show');


//user
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/index', 'UserController@index')->name('user.index'); //login user
// Route::get('user/edit_profil/{id}', 'UserController@edit');

Route::get('/user/index/{id}', 'UserController@show'); //profil
Route::get('/user/index/{id}/edit', 'UserController@edit'); //profil
Route::put('/user/index/{id}', 'UserController@update');
Route::get('/user/cektanggal', 'UserController@cek');


//peminjaman user
Route::get('user/peminjaman/create' , 'PeminjamanController@create');
Route::get('/user/peminjaman' , 'PeminjamanController@index');
Route::post('user/peminjaman' , 'PeminjamanController@store');

//riwayat peminjaman
Route::get('/admin/riwayatpeminjaman' , 'PeminjamanController@riwayat');
