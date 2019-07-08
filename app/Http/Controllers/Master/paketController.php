<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\paketModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class paketController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datapaket');
    }

    public function getDataPaket()
    {
        $paket = paketModel::query()
            ->select('idPaket','namaPaket', 'typeMobil', 'kaliPertemuan', 'jadwalBuka', 'jadwalTutup','harga')
            ->get();

        return DataTables::of($paket)
            ->addIndexColumn()
            ->addColumn('action', function ($paket) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditPaket(\'' . $paket->idPaket . '\',\'' . $paket->namaPaket . '\', \'' . $paket->typeMobil . '\', \'' . $paket->kaliPertemuan . '\', \'' . $paket->jadwalBuka . '\',\'' . $paket->jadwalTutup . '\',\'' . $paket->harga . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $paket->namaPaket . '\', event)" ><i class="fa fa-trash"></i></a>
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
                $paket = new paketModel();
                $paket->namaPaket = $r->namaPaket;
                $paket->typeMobil = $r->typeMobil;
                $paket->kaliPertemuan = $r->kaliPertemuan;
                $paket->jadwalBuka = $r->jadwalBuka;
                $paket->jadwalTutup = $r->jadwalTutup;
                $paket->harga = $r->harga;
                $paket->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $paket
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
                $id = $r->idPaket;
                $data = [
                    'namaPaket' => $r->namaPaket,
                    'typeMobil' => $r->typeMobil,
                    'kaliPertemuan' => $r->kaliPertemuan,
                    'jadwalBuka' => $r->jadwalBuka,
                    'jadwalTutup' => $r->jadwalTutup,
                    'harga' => $r->harga,
                ];
                paketModel::query()
                    ->where('idPaket', '=', $id)
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
        paketModel::query()
            ->where('namaPaket', '=', $id)
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
            'namaPaket' => 'required:tb_paket',
            'typeMobil' => 'required|max:255',
            'kaliPertemuan' => 'required|max:5',
            'jadwalBuka' => 'required',
            'jadwalTutup' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function caripaket(Request $request)
    {
        $daftarpaket = paketModel::query()
            ->select('idPaket', 'namaPaket', 'typeMobil', 'kaliPertemuan', 'jadwalBuka', 'jadwalTutup', 'harga')
            ->where([
                ['typeMobil', 'like', '%' . $request->typeMobil . '%'],
                ['jadwalBuka', 'like', '%' . $request->jadwal . '%',],
                ['kaliPertemuan', 'like', '%' . $request->kaliPertemuan . '%',]
            ])
            ->get();

        $contoh = $daftarpaket->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.daftarpaket')->with('daftarpaket', $daftarpaket)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
