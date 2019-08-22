<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\pembayaranModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class pembayaranController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.transaksi.datapembayaran');
    }


    public function insertPembayaran(Request $r)
    {

        $validator = Validator::make(
            $r->all(),
            [
                'urlFoto' => 'required|file|max:2048'
            ]
        );

        if ($validator->passes()) {
            $urlFoto = $r->file('urlFoto');
            $new_name = $r->noTrans . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('bukti'), $new_name);


            $pembayaran = new pembayaranModel();
            $pembayaran->noTrans = $r->noTrans;
            $pembayaran->tanggal = "2019-01-03";
            $pembayaran->bank = $r->bank;
            $pembayaran->bukti = $new_name;
            $pembayaran->save();
        } else { }
    }


    public function tampilpembayaran(Request $request)
    {
        $dataPembayaran = DB::table('tb_pembayaran')
            ->leftJoin('tb_paket', 'tb_pembayaran.idPaket', '=', 'tb_paket.idPaket')
            ->where([
                ['tb_pembayaran.usernameCustomer', '=', $request->username],
                ['tb_pembayaran.checkout', '=', '0']
            ])
            ->get();

        $total =  $dataPembayaran->sum('harga');
        $contoh = $dataPembayaran->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pembayaran')->with(['dataPembayaran' => $dataPembayaran, 'total' => $total])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Pembayaran anda akan tampil disini')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deletepembayaran(Request $request)
    {
        $idPembayaran = $request->idPembayaran;
        $data = pembayaranModel::find($idPembayaran);
        $data->delete();
    }

    public function showPembayaran(Request $request)
    {
        $caridata = $request->caridata;
        $pembayaran = pembayaranModel::join('tb_transaksi','tb_pembayaran.noTrans','tb_transaksi.noTrans')
            ->where('tb_pembayaran.noTrans', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tb_pembayaran.tanggal', 'LIKE', '%' . $caridata . '%')
            ->orwhere('bank', 'LIKE', '%' . $caridata . '%')
            ->orderby('status_bayar','asc')
            ->get();

        $contoh = $pembayaran->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabelPembayaran')->with('pembayaran', $pembayaran)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data pembayaran akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
