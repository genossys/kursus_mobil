<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Master\mobilModel;
use App\Master\pembayaranModel;
use Illuminate\Http\Request;
use App\Master\transaksiModel;
use App\Master\pesananModel;
use App\Master\tentorModel;

class pdfmaker extends Controller
{
    //
    public function cetakTransaksi(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataTransaksi($request));
        return $pdf->stream();
    }

    public function dataTransaksi(Request $request)
    {
        $dariTanggal = $request->dariTanggal;
        $sampaiTanggal = $request->sampaiTanggal;
        $status_bayar = $request->status_bayar;
        $status_terima = $request->status_terima;

        $transaksi = transaksiModel::wherebetween('tanggal', [$dariTanggal, $sampaiTanggal])
            ->where('status_bayar', 'LIKE', '%' . $status_bayar . '%')
            ->where('status_terima', 'LIKE', '%' . $status_terima . '%')
            ->get();

        $grandTotal = $transaksi->sum('total');
        $contoh = $transaksi->first();

        if ($contoh != null) {
            return view('admin.laporan.pdfTransaksi')->with([
                'transaksi' => $transaksi, 'grandTotal' => $grandTotal,
                'dariTanggal' => $dariTanggal, 'sampaiTanggal' => $sampaiTanggal,
                'status_bayar' => $status_bayar, 'status_terima' => $status_terima,
            ]);
        } else {
            return view('admin.laporan.pdfKosong')->with('kosong', 'Data Transaksi Kosong/ Tidak ada');
        }
    }

    public function cetakPesanan(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPesanan($request));
        return $pdf->stream();
    }

    public function dataPesanan(Request $request)
    {
        $dariTanggal = $request->dariTanggal;
        $sampaiTanggal = $request->sampaiTanggal;
        $mobil = $request->mobil;
        $tentor = $request->tentor;

        $pesanan = pesananModel::join('tb_paket', 'tb_pesanan.idPaket', 'tb_paket.idPaket')
            ->join('tb_mobil', 'tb_pesanan.reqMobil', 'tb_mobil.idMobil')
            ->join('tb_tentor', 'tb_pesanan.reqTentor', 'tb_tentor.idTentor')
            ->join('tb_transaksi', 'tb_pesanan.noTrans', 'tb_transaksi.noTrans')
            ->wherebetween('reqTglMulai', [$dariTanggal, $sampaiTanggal])
            ->where('merkMobil', 'LIKE', '%' . $mobil . '%')
            ->where('namaTentor', 'LIKE', '%' . $tentor . '%')
            ->where('status_terima', 'diterima')
            ->get();

        $contoh = $pesanan->first();


        if ($contoh != null) {
            return view('admin.laporan.pdfPesanan')->with([
                'pesanan' => $pesanan,
                'dariTanggal' => $dariTanggal, 'sampaiTanggal' => $sampaiTanggal,
                'mobil' => $mobil, 'tentor' => $tentor,
            ]);
        } else {
            return view('admin.laporan.pdfKosong')->with('kosong', 'Data Pesanan Kosong/ Tidak ada');
        }
    }

    public function cetakTentor(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataTentor($request));
        return $pdf->stream();
    }

    public function dataTentor(Request $request)
    {
        $state = $request->state;
        $caridata = $request->caridata;
        $tentor = tentorModel::where('namaTentor', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalLahir', 'LIKE', '%' . $caridata . '%')
            ->orwhere('biodata', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $tentor->first();

        if ($contoh != null) {
            return view('admin.laporan.pdfTentor')->with(['tentor' => $tentor, 'state' => $state]);
        } else {
            return view('admin.laporan.pdfKosong')->with('kosong', 'Data Pesanan Kosong/ Tidak ada');
        }
    }

    public function cetakMobil(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataMobil($request));
        return $pdf->stream();
    }

    public function dataMobil(Request $request)
    {
        $caridata = $request->caridata;
        $state = $request->state;
        $mobil = mobilModel::where('merkMobil', 'LIKE', '%' . $caridata . '%')
            ->orwhere('typeMobil', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tahun', 'LIKE', '%' . $caridata . '%')
            ->orwhere('noPol', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $mobil->first();

        if ($contoh != null) {
            return view('admin.laporan.pdfMobil')->with(['mobil' => $mobil, 'state' => $state]);
        } else {
            return view('admin.laporan.pdfKosong')->with('kosong', 'Data yang anda cari tidak ada');
        }
    }

    public function cetakNota($noTrans)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataCetakNota($noTrans));
        return $pdf->stream();
    }

    public function dataCetakNota($noTrans)
    {
        $nota = pembayaranModel::join('tb_pesanan', 'tb_pesanan.noTrans', 'tb_pembayaran.noTrans')
            ->where('tb_pembayaran.noTrans', $noTrans)
            ->first();


        if ($nota != null) {
            return view('admin.laporan.pdfNota')->with(['nota' => $nota]);
        } else {
            return view('admin.laporan.pdfKosong')->with('kosong', 'Data yang anda cari tidak ada');
        }
    }
}
