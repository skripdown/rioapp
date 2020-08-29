<?php
/** @noinspection PhpUndefinedClassInspection */

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


//GET:ROUTE
Auth::routes();
Route::get('/','AppController@routeHome');
Route::get('/scanner','AppController@routeScanner');
Route::get('/home','AppController@routeHome')->name('home');
Route::get('/pengguna','AppController@routeDataPengguna');
Route::get('/rapat_terkini','AppController@routeRapatTerkini');
Route::get('/rapat/{id}','AppController@routeRapatDetail');
Route::get('/show_qr_scanner','AppController@routeScannerQR');
Route::get('/arsip','AppController@routeArsip');
Route::get('/laporan/{id}','AppController@routeLaporan');
Route::get('logout', 'Auth\LoginController@logout');

//POST METHOD
Route::post('post_qr_code','AppController@read_code');
Route::post('post_scanner_code','AppController@init_scanner');
Route::post('post_set_izin','AppController@set_izin');
Route::post('post_update_qr','AppController@update_code');
Route::post('post_check_rapat','AppController@check_rapat');
Route::post('post_check_admin_rapat','AppController@check_admin_rapat');
Route::post('post_create_rapat','AppController@newRapat');
Route::post('post_end_rapat','AppController@endRapat');
