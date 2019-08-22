<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Master\mobilModel;
use Illuminate\Foundation\Auth\RegistersUsers;


class mobilController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datamobil');
    }

    public function laporanMobil()
    {
        return view('admin.laporan.laporanMobil');
    }

    public function insert(Request $r)
    {
        $validator = Validator::make(
            $r->all(),
            [
                'urlFoto' => 'required|file|max:2048'
            ]
        );

        if ($validator->passes()) {
            $urlFoto = $r->file('urlFoto');
            $new_name = $r->merkMobil . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('mobil'), $new_name);


            $mobil = new mobilModel();
            $mobil->merkMobil = $r->merkMobil;
            $mobil->typeMobil = $r->typeMobil;
            $mobil->tahun = $r->tahun;
            $mobil->noPol = $r->noPol;
            $mobil->gambar = $new_name;
            $mobil->save();
        } else { }
    }

    public function showMobil(Request $request)
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
            $returnHTML = view('isipage.tabelMobil')->with(['mobil'=> $mobil, 'state'=>$state])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data mobil akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }


    public function edit(Request $r)
    {

        $validator = Validator::make(
            $r->all(),
            [
                'urlFoto' => 'required|file|max:2048'
            ]
        );

        if ($validator->passes()) {
            $urlFoto = $r->file('urlFoto');
            $new_name = $r->merkMobil . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('mobil'), $new_name);
        } else { }

        $mobil = mobilModel::find($r->idMobil);
        $mobil->merkMobil = $r->merkMobil;
        $mobil->typeMobil = $r->typeMobil;
        $mobil->tahun = $r->tahun;
        $mobil->noPol = $r->noPol;
        if ($r->urlFoto != "") {
            $mobil->gambar = $new_name;
        }
        $mobil->save();
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
        $state = $request->state;
        $cariMobil = $request->cariMobil;
        $dataMobil = mobilModel::where('merkMobil', 'LIKE', "%" . $cariMobil . "%")
            ->orwhere('typeMobil', 'LIKE', "%" . $cariMobil . "%")
            ->orwhere('tahun', 'LIKE', "%" . $cariMobil . "%")
            ->get();
        $contoh = $dataMobil->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pencarianmobil')->with(['dataMobil'=> $dataMobil, 'state'=>$state])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Mobil yang anda cari tidak tersedia')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showEditMobil(Request $request)
    {
        $id = $request->id;
        $mobil = mobilModel::where('idMobil', $id)
            ->first();

        if ($mobil != null) {
            $returnHTML = view('isipage.modalEditMobil')->with('mobil', $mobil)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data mobil akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deleteData(Request $request)
    {
        $mobil = mobilModel::find($request->idMobil);
        $mobil->delete();
    }
}
