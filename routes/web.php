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
Route::get('/login', 'auth\LoginController@login')->name('login');
Route::post('/postlogin', 'auth\LoginController@postlogin');
Route::get('/logout', 'auth\LoginController@logout')->name('logout');

Route::get('/paket', function () {
    return view('/umum/paket');
})->name('paket');


Route::group(['middleware' => 'auth'], function () {


    Route::get('/admin', function () {
        return view('/admin/menuawal');
    })->name('admin');


    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Master\userController@index')->name('pageuser');
            Route::get('/dataUser', 'Master\userController@getDataUser');
            Route::post('/simpanUser', 'Master\userController@addUser');
            Route::post('/editUser', 'Master\userController@editUser');
            Route::post('/editPassword', 'Master\userController@editPassword');
            Route::delete('/deleteUser', 'Master\userController@delete');
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', 'Master\customerController@index')->name('pagecustomer');
            Route::get('/dataCustomer', 'Master\customerController@getDataCustomer');
            Route::post('/simpanCustomer', 'Master\customerController@insert');
            Route::post('/editCustomer', 'Master\customerController@edit');
            Route::delete('/deleteCustomer', 'Master\customerController@delete');
        });

        Route::group(['prefix' => 'paket'], function () {
            Route::get('/', 'Master\paketController@index')->name('pagepaket');
            Route::get('/dataPaket', 'Master\paketController@getDataPaket');
            Route::post('/simpanPaket', 'Master\paketController@insert');
            Route::post('/editPaket', 'Master\paketController@edit');
            Route::delete('/deletePaket', 'Master\paketController@delete');
            Route::get('/caripaket', 'Master\paketController@caripaket')->name('caripaket');
        });

        Route::group(['prefix' => 'mobil'], function () {
            Route::get('/', 'Master\mobilController@index')->name('pagemobil');
            Route::get('/dataMobil', 'Master\mobilController@getDataMobil');
            Route::post('/simpanMobil', 'Master\mobilController@insert');
            Route::post('/editMobil', 'Master\mobilController@edit');
            Route::delete('/deleteMobil', 'Master\mobilController@delete');
        });

        Route::group(['prefix' => 'tentor'], function () {
            Route::get('/', 'Master\tentorController@index')->name('pagetentor');
            Route::get('/dataTentor', 'Master\tentorController@getDataTentor');
            Route::post('/simpanTentor', 'Master\tentorController@insert');
            Route::post('/editTentor', 'Master\tentorController@edit');
            Route::delete('/deleteTentor', 'Master\tentorController@delete');
        });
    });
});
Route::get('/home', 'HomeController@index')->name('home');
