<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\pesananModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class pesananController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datapesanan');
    }

    public function getDataPesanan()
    {
        $pesanan = pesananModel::query()
            ->select('idPesanan', 'merkPesanan', 'typePesanan', 'tahun', 'noPol', 'gambar')
            ->get();

        return DataTables::of($pesanan)
            ->addIndexColumn()
            ->addColumn('action', function ($pesanan) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditPesanan(\'' . $pesanan->idPesanan . '\',\'' . $pesanan->merkPesanan . '\', \'' . $pesanan->typePesanan . '\', \'' . $pesanan->tahun . '\', \'' . $pesanan->noPol . '\',\'' . $pesanan->gambar . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $pesanan->idPesanan . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insert(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            try {
                $pesanan = new pesananModel();
                $pesanan->merkPesanan = $r->merkPesanan;
                $pesanan->typePesanan = $r->typePesanan;
                $pesanan->tahun = $r->tahun;
                $pesanan->noPol = $r->noPol;
                $pesanan->gambar = $r->gambar;
                $pesanan->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $pesanan
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => false,
                    'data' => $th
                ]);
            }
        }
    }


    public function edit(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            try {
                $id = $r->idPesanan;
                $data = [
                    'merkPesanan' => $r->merkPesanan,
                    'typePesanan' => $r->typePesanan,
                    'tahun' => $r->tahun,
                    'noPol' => $r->noPol,
                    'tahun' => $r->tahun,
                ];
                pesananModel::query()
                    ->where('idPesanan', '=', $id)
                    ->update($data);
                return response()
                    ->json([
                        'sqlResponse' => true,
                        'sukses' => $data,
                        'valid' => true,
                    ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'sqlResponse' => false,
                    'data' => $th,
                    'valid' => true,
                ]);
            }
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        pesananModel::query()
            ->where('idPesanan', '=', $id)
            ->delete();
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'sqlResponse' => true,
        ]);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'merkPesanan' => 'required:tb_pesanan',
            'typePesanan' => 'required|max:30',
            'tahun' => 'required|max:4',
            'noPol' => 'required|max:12|unique:tb_pesanan',
            'gambar' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function insertpesanan(Request $request)
    {

        $pesanan = new pesananModel();
        $pesanan->noTrans = $request->noTrans;
        $pesanan->idPaket = $request->idPaket;
        $pesanan->idCustomer = $request->idCustomer;
        $pesanan->harga = $request->harga;
        $pesanan->save();
    }

    public function tampilpesanan(Request $request)
    {
        $dataPesanan = DB::table('tb_pesanan')
            ->leftJoin('tb_paket', 'tb_pesanan.idPaket', '=', 'tb_paket.idPaket')
            ->where([
                ['tb_pesanan.idCustomer', '=', $request->idCustomer],
                ['tb_pesanan.checkout', '=', '0']
            ])
            ->get();

        $total =  $dataPesanan->sum('harga');
        $contoh = $dataPesanan->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pesanan')->with(['dataPesanan' => $dataPesanan, 'total' => $total])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Pesanan anda akan tampil disini')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deletepesanan(Request $request)
    {
        $idPesanan = $request->idPesanan;
        $data = pesananModel::find($idPesanan);
        $data->delete();
    }

    public function keranjangPesanan()
    {
        return view('umum.keranjang');
    }

    public function checkoutPesanan(Request $request)
    {
        $dataPesanan = DB::table('tb_pesanan')
            ->leftJoin('tb_paket', 'tb_pesanan.idPaket', '=', 'tb_paket.idPaket')
            ->leftJoin('tb_mobil', 'tb_pesanan.reqMobil', '=', 'tb_mobil.idMobil')
            ->leftJoin('tb_tentor', 'tb_pesanan.reqTentor', '=', 'tb_tentor.idTentor')
            ->where([
                ['tb_pesanan.idCustomer', '=', $request->idCustomer],
                ['tb_pesanan.checkout', '=', '0']
            ])
            ->get();

        $total =  $dataPesanan->sum('harga');
        $contoh = $dataPesanan->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pesanandetail')->with(['dataPesanan' => $dataPesanan, 'total' => $total])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Pesanan anda akan tampil disini')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function requestKursus(Request $request)
    {
        $id = $request->idPesanan;
        $pesanan = pesananModel::find($id);
        $pesanan->reqTglMulai = $request->reqtgl;
        $pesanan->reqWaktu = $request->reqjam;
        $pesanan->reqMobil = $request->reqMobil;
        $pesanan->reqTentor = $request->reqTentor;
        $pesanan->save();
    }

    public function bayarsekarang(Request $request)
    {
        $noTrans = $request->noTrans;
        $idCustomer = $request->idCustomer;
        DB::table('tb_pesanan')
            ->where('idCustomer', '=', $idCustomer)
            ->where('noTrans', '=', $noTrans)
            ->update(['checkout' => '1']);
    }

    public function pesananadmin(Request $request)
    {
        $dataPesanan = DB::table('tb_pesanan')
            ->leftJoin('tb_paket', 'tb_pesanan.idPaket', '=', 'tb_paket.idPaket')
            ->leftJoin('tb_mobil', 'tb_pesanan.reqMobil', '=', 'tb_mobil.idMobil')
            ->leftJoin('tb_tentor', 'tb_pesanan.reqTentor', '=', 'tb_tentor.idTentor')
            ->where([
                ['tb_pesanan.noTrans', '=', $request->noTrans],
            ])
            ->get();

        $total =  $dataPesanan->sum('harga');
        $contoh = $dataPesanan->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pesanandetailadmin')->with(['dataPesanan' => $dataPesanan, 'total' => $total])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Pesanan anda akan tampil disini')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
