<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\mobilModel;
use Illuminate\Foundation\Auth\RegistersUsers;


class mobilController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datamobil');
    }

    public function getDataMobil()
    {
        $mobil = mobilModel::query()
            ->select('idMobil', 'merkMobil', 'typeMobil', 'tahun', 'noPol', 'gambar')
            ->get();

        return DataTables::of($mobil)
            ->addIndexColumn()
            ->addColumn('action', function ($mobil) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditMobil(\'' . $mobil->idMobil . '\',\'' . $mobil->merkMobil . '\', \'' . $mobil->typeMobil . '\', \'' . $mobil->tahun . '\', \'' . $mobil->noPol . '\',\'' . $mobil->gambar . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $mobil->idMobil . '\', event)" ><i class="fa fa-trash"></i></a>
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
                $mobil = new mobilModel();
                $mobil->merkMobil = $r->merkMobil;
                $mobil->typeMobil = $r->typeMobil;
                $mobil->tahun = $r->tahun;
                $mobil->noPol = $r->noPol;
                $mobil->gambar = $r->gambar;
                $mobil->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $mobil
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
                $id = $r->idMobil;
                $data = [
                    'merkMobil' => $r->merkMobil,
                    'typeMobil' => $r->typeMobil,
                    'tahun' => $r->tahun,
                    'noPol' => $r->noPol,
                    'tahun' => $r->tahun,
                ];
                mobilModel::query()
                    ->where('idMobil', '=', $id)
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
        mobilModel::query()
            ->where('idMobil', '=', $id)
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
            'merkMobil' => 'required:tb_mobil',
            'typeMobil' => 'required|max:30',
            'tahun' => 'required|max:4',
            'noPol' => 'required|max:12|unique:tb_mobil',
            'gambar' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }


    public function pencarianMobil(Request $request)
    {
        $cariMobil = $request->cariMobil;
        $dataMobil = mobilModel::where('merkMobil', 'LIKE', "%" . $cariMobil . "%")
            ->orwhere('typeMobil', 'LIKE', "%" . $cariMobil . "%")
            ->orwhere('tahun', 'LIKE', "%" . $cariMobil . "%")
            ->get();
        $contoh = $dataMobil->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pencarianmobil')->with('dataMobil', $dataMobil)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong','Mobil yang anda cari tidak tersedia')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
