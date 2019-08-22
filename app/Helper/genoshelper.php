<?php

use App\Master\pesananModel;
use App\Master\paketModel;
use App\Master\customerModel;

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function formatDate($tanggal)
{
    return date("Y-m-d", strtotime($tanggal));
}

function formatDateToSurat($tanggal)
{
    return date("d-M-Y", strtotime($tanggal));
}

function formatuang($angka)
{
    return  number_format($angka, 0, '', '.');
}

function sisaKeranjang($username)
{
    $keranjang = pesananModel::where('checkout', '0')->where('usernameCustomer', $username)->count();
    return  $keranjang;
}

function jamAwal($idPaket)
{
    $paket = paketModel::select('jadwalBuka')->where('idPaket', $idPaket)->first();
    return  $paket;
}

function noTrans_otomatis($id)
{
    $sekarang = Carbon\Carbon::now()->format('YmdHms');
    $notrans = $id . $sekarang;

    $pesanan = pesananModel::where('checkout', '=', '0')
        ->where('usernameCustomer', '=', $id)
        ->orderby('noTrans', 'desc')->first();

    if (!$pesanan == null) {
        return $pesanan->noTrans;
    } else {
        return $notrans;
    }
}

function getNoHp($username)
{
    $customer = customerModel::select('nohp')->where('username',$username)->first();
    $noHp = $customer['nohp'];
    return $noHp;
}
