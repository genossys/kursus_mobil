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

Route::get('/', 'Controller@welcome');

Route::get('/registermember', 'Master\customerController@showFormRegistrasi');
Route::post('/postRegister', 'Master\customerController@register')->name('registermember');
Auth::routes();


//Login
Route::get('/login', 'auth\LoginController@login')->name('login');
Route::post('/postlogin', 'auth\LoginController@postlogin');
Route::get('/logout', 'auth\LoginController@logout')->name('logout');

Route::get('/caripaket', 'Master\paketController@caripaket')->name('caripaket');
Route::get('/tampilpesanan', 'Transaksi\pesananController@tampilpesanan')->name('tampilpesanan');
Route::post('/insertPesanan', 'Transaksi\pesananController@insertpesanan')->name('insertpesanan');
Route::post('/insertTransaksi', 'Transaksi\transaksiController@insertTransaksi');
Route::post('/updateStatusPembayaran', 'Transaksi\transaksiController@updateStatusPembayaran');

Route::post('/insertPembayaran', 'Transaksi\pembayaranController@insertPembayaran');

Route::post('/deletePesanan', 'Transaksi\pesananController@deletepesanan')->name('deletepesanan');
Route::post('/bayarsekarang', 'Transaksi\pesananController@bayarsekarang')->name('bayarsekarang');
Route::post('/requestKursus', 'Transaksi\pesananController@requestKursus')->name('requestKursus');
Route::get('/keranjangPesanan', 'Transaksi\pesananController@keranjangpesanan')->name('keranjangPesanan');
Route::get('/historyTransaksi', 'Transaksi\transaksiController@historyTransaksi')->name('historyTransaksi');
Route::get('/tampilTransaksi', 'Transaksi\transaksiController@tampilTransaksi')->name('tampilTransaksi');
Route::get('/tampilTransaksiUser', 'Transaksi\transaksiController@tampilTransaksiUser');
Route::get('/pembayaran/{noTrans}', 'Transaksi\transaksiController@pembayaran')->name('pembayaran');

Route::get('/pencarianMobil', 'Master\mobilController@pencarianMobil')->name('pencarianMobil');
Route::get('/pencarianTentor', 'Master\tentorController@pencarianTentor')->name('pencarianTentor');
Route::get('/checkoutPesanan', 'Transaksi\pesananController@checkoutPesanan')->name('checkoutPesanan');
Route::get('/pesananadmin', 'Transaksi\pesananController@pesananadmin')->name('pesananadmin');

Route::get('/paket', function () {
    return view('/umum/paket');
})->name('paket');

Route::get('/profil', function () {
    return view('/umum/profil');
})->name('profil');

Route::group(['middleware' => 'auth'], function () {


    Route::get('/admin', function () {
        return view('/admin/menuawal');
    })->name('admin');


    Route::group(['prefix' => 'admin'], function () {

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Master\userController@index')->name('pageuser');
            Route::get('/showUser', 'Master\userController@showUser');
            Route::get('/showEditUser', 'Master\userController@showEditUser');
            Route::post('/simpanUser', 'Master\userController@insert');
            Route::post('/editUser', 'Master\userController@edit');
            Route::post('/editPassword', 'Master\userController@editPassword');
            Route::delete('/deleteData', 'Master\userController@deleteData');
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
        });

        Route::group(['prefix' => 'mobil'], function () {
            Route::get('/', 'Master\mobilController@index')->name('pagemobil');
            Route::get('/laporanMobil', 'Master\mobilController@laporanMobil')->name('laporanMobil');
            Route::get('/showMobil', 'Master\mobilController@showMobil');
            Route::get('/showEditMobil', 'Master\mobilController@showEditMobil');
            Route::post('/simpanMobil', 'Master\mobilController@insert');
            Route::post('/editMobil', 'Master\mobilController@edit');
            Route::delete('/deleteData', 'Master\mobilController@deleteData');
        });

        Route::group(['prefix' => 'tentor'], function () {
            Route::get('/', 'Master\tentorController@index')->name('pagetentor');
            Route::get('/laporanTentor', 'Master\tentorController@laporanTentor')->name('laporanTentor');
            Route::get('/showTentor', 'Master\tentorController@showTentor');
            Route::get('/showEditTentor', 'Master\tentorController@showEditTentor');
            Route::post('/simpanTentor', 'Master\tentorController@insert');
            Route::post('/editTentor', 'Master\tentorController@edit');
            Route::delete('/deleteData', 'Master\tentorController@deleteData');
        });

        Route::group(['prefix' => 'transaksi'], function () {
            Route::get('/', 'Transaksi\transaksiController@index')->name('pagetransaksi');
            Route::get('/laporanTransaksi', 'Transaksi\transaksiController@laporanTransaksi')->name('laporantransaksi');
            Route::get('/showtransaksi', 'Transaksi\transaksiController@showtransaksi');
            Route::get('/showlaporantransaksi', 'Transaksi\transaksiController@showlaporantransaksi');
            Route::get('/showEdittransaksi', 'Transaksi\transaksiController@showEdittransaksi');
            Route::post('/updateStatusTerima', 'Transaksi\transaksiController@updateStatusTerima');
            Route::post('/updateStatusPembayaran', 'Transaksi\transaksiController@updateStatusPembayaran');
        });

        Route::group(['prefix' => 'pesanan'], function () {
            Route::get('/', 'Transaksi\pesananController@index')->name('pagepesanan');
            Route::get('/laporanPesanan', 'Transaksi\pesananController@laporanPesanan')->name('laporanpesanan');
            Route::get('/showpesanan', 'Transaksi\pesananController@showpesanan');
            Route::get('/showlaporanpesanan', 'Transaksi\pesananController@showlaporanpesanan');
        });

        Route::group(['prefix' => 'pembayaran'], function () {
            Route::get('/', 'Transaksi\pembayaranController@index')->name('pagepembayaran');
            Route::get('/showpembayaran', 'Transaksi\pembayaranController@showpembayaran');
            Route::get('/showEditpembayaran', 'Transaksi\pembayaranController@showEditpembayaran');
        });

        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('/', 'Master\jadwalController@index')->name('jadwalKursus');
            Route::post('/insertJadwal', 'Master\jadwalController@insert');
        });

        Route::group(['prefix' => 'cetak'], function () {
            Route::get('/cetakTransaksi', 'pdfmaker@cetakTransaksi')->name('cetakTransaksi');
            Route::get('/cetakPesanan', 'pdfmaker@cetakPesanan')->name('cetakPesanan');
            Route::get('/cetakTentor', 'pdfmaker@cetakTentor')->name('cetakTentor');
            Route::get('/cetakMobil', 'pdfmaker@cetakMobil')->name('cetakMobil');
            Route::get('/cetakNota/{noTrans}', 'pdfmaker@cetakNota')->name('cetakNota');
        });
    });
});


Route::get('/home', 'HomeController@index')->name('home');
