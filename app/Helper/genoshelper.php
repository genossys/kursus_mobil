<?php

use App\Master\pesananModel;

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

function noTrans_otomatis($idCus)
{
    $sekarang = Carbon\Carbon::now()->format('YmdHHmmss');
    $notrans = $idCus . $sekarang;

    $pesanan = pesananModel::where('checkout', '=', '0')
        ->where('idCustomer', '=', $idCus)
        ->orderby('noTrans', 'desc')->first();

    if (!$pesanan == null) {
        return $pesanan->noTrans;
    } else {
        return $notrans;
    }
}


//     $nomor = 'PO-'.$tahun.'-'.$bulan.'-'.$nomorPOnya;
//     return $nomor;
// }


// function nomorPPB_otomatis(){
//     $sekarang = Carbon\Carbon::now()->format('Y-m-d');
//     $tahun = substr($sekarang,0,4);
//     $bulan = substr($sekarang,5,2);

//     $ppbTerahkir1 = '';
//     $ppbTahun = '';
//     $ppbBulan = '';

//     $ppbTerahkir = DB::table('ppbs')->orderby('no_ppb','desc')->first();

//     if($ppbTerahkir != ''){
//     $ppbTerahkir1 = $ppbTerahkir->no_ppb;
//     $ppbTahun = substr($ppbTerahkir1,5,4);
//     $ppbBulan = substr($ppbTerahkir1,10,2);
//     }

//     if($ppbTerahkir1 != '' && $ppbTahun != $tahun && $ppbBulan != $bulan){
//         $nomorterahkir = substr($ppbTerahkir1,12,3);
//         $nomorPPBnya = $nomorterahkir + 1;
//         $nomorPPBnya = str_pad($nomorPPBnya,3,'0',STR_PAD_LEFT);
//     }else{
//         $nomorPPBnya = '001';
//     }



//     $nomor = 'PPB-'.$tahun.'-'.$bulan.'-'.$nomorPPBnya;
//     return $nomor;
// }

// function nomorNota_otomatis(){
//     $sekarang = Carbon\Carbon::now()->format('Y-m-d');
//     $tahun = substr($sekarang,0,4);
//     $bulan = substr($sekarang,5,2);

//     $poTerahkir1 = '';
//     $poTahun = '';
//     $poBulan = '';

//     $poTerahkir = DB::table('penerimaan_barang')->orderby('no_nota','desc')->first();
//     if($poTerahkir != 'belum ada nota') {
//         $poTerahkir1 = $poTerahkir->no_nota;
//         $poTahun = substr($poTerahkir1, 4, 4);
//         $poBulan = substr($poTerahkir1, 9, 2);
//     }
//     if($poTerahkir1 != 'belum ada nota' && $poTahun != $tahun && $poBulan != $bulan){
//         $nomorterahkir = substr($poTerahkir1,11,3);
//         $nomorPOnya = $nomorterahkir + 1;
//         $nomorPOnya = str_pad($nomorPOnya,3,'0',STR_PAD_LEFT);
//     }else{
//         $nomorPOnya = '001';
//     }



//     $nomor = 'NO-'.$tahun.'-'.$bulan.'-'.$nomorPOnya;
//     return $nomor;
// }
