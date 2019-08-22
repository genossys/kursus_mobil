<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Master\transaksiModel;
use Illuminate\Foundation\Auth\RegistersUsers;

class transaksiController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.transaksi.datatransaksi');
    }

    public function laporanTransaksi()
    {
        return view('admin.laporan.laporantransaksi');
    }

    public function getDataTransaksi()
    {
        $transaksi = transaksiModel::query()
            ->select('noTrans', 'usernameCustomer', 'total', 'tanggal', 'batasPembayaran', 'status_bayar', 'status_terima')
            ->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->addColumn('status_bayar', function ($transaksi) {
                if ($transaksi->status_bayar == 'belum') {
                    return '<a class="text-danger">belum</a>';
                } else if ($transaksi->status_bayar == 'sudah') {
                    return '<a class="text-success">sudah</a>';
                } else if ($transaksi->status_bayar == 'menunggu') {
                    return '<a class="text-warning">menunggu</a>';
                } else {
                    return '<a class="text-warning">ditolak</a>';
                }
            })
            ->addColumn('action', function ($transaksi) {
                return '<a class="btn-sm btn-warning" id="btn-edit" data-toggle="modal" data-target="#modalDetail" onclick="tampilDetail(\'' . $transaksi->noTrans . '\')"><i class="fa fa-bars"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $transaksi->noTrans . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action', 'status_bayar'])
            ->make(true);
    }



    public function delete(Request $r)
    {
        $id = $r->input('id');
        transaksiModel::query()
            ->where('namaTransaksi', '=', $id)
            ->delete();
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'sqlResponse' => true,
        ]);
    }



    // =================================================================================
    public function historyTransaksi()
    {
        return view('umum.historitransaksi');
    }


    public function tampilTransaksi(Request $request)
    {
        $transaksi = transaksiModel::query()
            ->select('noTrans', 'total', 'tanggal', 'batasPembayaran', 'status_bayar', 'status_terima')
            ->orderby('noTrans', 'desc')
            ->get();

        $contoh = $transaksi->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabeltransaksi')->with('transaksi', $transaksi)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data Transaksi anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function tampilTransaksiUser(Request $request)
    {
        $transaksi = transaksiModel::query()
            ->select('noTrans', 'total', 'tanggal', 'batasPembayaran', 'status_bayar', 'status_terima')
            ->orderby('noTrans', 'desc')
            ->where('usernameCustomer', auth()->user()->username)
            ->get();

        $contoh = $transaksi->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabeltransaksi')->with('transaksi', $transaksi)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data Transaksi anda mobil akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function insertTransaksi(Request $request)
    {
        $transaksi = new transaksiModel();
        $transaksi->noTrans = $request->noTrans;
        $transaksi->usernameCustomer = auth()->user()->username;
        $transaksi->total = $request->total;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->batasPembayaran = $request->batasPembayaran;
        $transaksi->save();
    }

    public function pembayaran($noTrans)
    {

        $transaksi = transaksiModel::where('noTrans', '=', $noTrans)
            ->get();

        //   dd($transaksi);
        return view('umum.pembayaran')->with('data', $transaksi);
    }

    public function updateStatusTerima(Request $request)
    {
        $transaksi = transaksiModel::find($request->noTrans);
        $transaksi->status_terima = $request->statusTerima;
        $transaksi->save();
    }

    public function updateStatusPembayaran(Request $request)
    {
        $status = $request->status;
        $transaksi = transaksiModel::find($request->noTrans);
        $transaksi->status_bayar = $status;
        $transaksi->save();
    }


    public function showtransaksi(Request $request)
    {
        $caridata = $request->caridata;
        $transaksi = transaksiModel::where('noTrans', 'LIKE', '%' . $caridata . '%')
            ->orwhere('usernameCustomer', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggal', 'LIKE', '%' . $caridata . '%')
            ->orderby('tanggal','desc')
            ->get();

        $contoh = $transaksi->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabeltransaksiAdmin')->with('transaksi', $transaksi)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data transaksi akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showlaporantransaksi(Request $request)
    {
        $dariTanggal = $request->dariTanggal;
        $sampaiTanggal = $request->sampaiTanggal;
        $status_bayar = $request->status_bayar;
        $status_terima = $request->status_terima;

        $transaksi = transaksiModel::wherebetween('tanggal', [$dariTanggal, $sampaiTanggal])
            ->where('status_bayar', 'LIKE', '%' . $status_bayar . '%')
            ->where('status_terima', 'LIKE', '%' . $status_terima . '%')
            ->orderby('tanggal','desc')
            ->get();

        $grandTotal = $transaksi->sum('total');
        $contoh = $transaksi->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabeltransaksiLaporan')->with(['transaksi' => $transaksi, 'grandTotal' => $grandTotal])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data transaksi akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
