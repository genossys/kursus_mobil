<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
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

    public function getDataTransaksi()
    {
        $transaksi = transaksiModel::query()
            ->select('idTransaksi', 'noTrans', 'idCustomer', 'total', 'tanggal', 'batasPembayaran', 'status_bayar', 'status_terima')
            ->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->addColumn('status_bayar', function ($transaksi) {
                if ($transaksi->status_bayar == 'belum') {
                    return '<a class="text-danger">belum</a>';
                }else if($transaksi->status_bayar == 'sudah') {
                    return '<a class="text-success">belum</a>';
                }else if($transaksi->status_bayar == 'menunggu') {
                    return '<a class="text-warning">menunggu</a>';
                }
            })
            ->addColumn('action', function ($transaksi) {
                return '<a class="btn-sm btn-warning" id="btn-edit" data-toggle="modal" data-target="#modalDetail" onclick="tampilDetail(\'' . $transaksi->noTrans . '\')"><i class="fa fa-bars"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $transaksi->idTransaksi . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action','status_bayar'])
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
        $daftartransaksi = transaksiModel::query()
            ->select('idTransaksi', 'noTrans', 'total', 'tanggal', 'batasPembayaran', 'status_bayar', 'status_terima')
            ->orderby('noTrans', 'desc')
            ->get();

        $contoh = $daftartransaksi->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabeltransaksi')->with('daftartransaksi', $daftartransaksi)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.transaksikosong')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function insertTransaksi(Request $request)
    {
        $transaksi = new transaksiModel();
        $transaksi->noTrans = $request->noTrans;
        $transaksi->idCustomer = $request->idCustomer;
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
}
