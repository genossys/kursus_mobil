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

Route::get('/', function () {
    return view('umum/welcome');
});

Auth::routes();


//Login
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'],function(){


Route::get('/admin', function () {
    return view('/admin/menuawal');
})->name('admin');

Route::get('/paket', function () {
    return view('/admin/master/datapaket');
})->name('paket');

Route::get('/user', function () {
    return view('/admin/master/datauser');
})->name('user');

Route::get('/mobil', function () {
    return view('/admin/master/datamobil');
})->name('mobil');

Route::get('/tentor', function () {
    return view('/admin/master/datatentor');
})->name('tentor');



});

Route::get('/home', 'HomeController@index')->name('home');
