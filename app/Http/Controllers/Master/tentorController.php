<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\tentorModel;
use Illuminate\Foundation\Auth\RegistersUsers;

class tentorController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datatentor');
    }

    public function laporanTentor()
    {
        return view('admin.laporan.laporanTentor');
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'namaTentor' => 'required',
            'tanggalLahir' => 'required',
            'biodata' => 'required',
            'foto' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function pencarianTentor(Request $request)
    {
        $cariTentor = $request->cariTentor;
        $dataTentor = tentorModel::where('namaTentor', 'LIKE', "%" . $cariTentor . "%")
            ->orwhere('biodata', 'LIKE', "%" . $cariTentor . "%")
            ->get();
        $contoh = $dataTentor->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pencarianTentor')->with('dataTentor', $dataTentor)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Tentor yang anda cari tidak tersedia')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
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
            $new_name = $r->namaTentor . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('tentor'), $new_name);


            $tentor = new tentorModel();
            $tentor->namaTentor = $r->namaTentor;
            $tentor->tanggalLahir = $r->tanggalLahir;
            $tentor->biodata = $r->biodata;
            $tentor->foto = $new_name;
            $tentor->save();
        } else { }
    }

    public function showTentor(Request $request)
    {
        $state = $request->state;
        $caridata = $request->caridata;
        $tentor = tentorModel::where('namaTentor', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalLahir', 'LIKE', '%' . $caridata . '%')
            ->orwhere('biodata', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $tentor->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabelTentor')->with(['tentor'=> $tentor, 'state' => $state])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data tentor akan Tampil di sini ')->render();
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
            $new_name = $r->namaTentor . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('tentor'), $new_name);
        } else { }

        $tentor = tentorModel::find($r->idTentor);
        $tentor->namaTentor = $r->namaTentor;
        $tentor->tanggalLahir = $r->tanggalLahir;
        $tentor->biodata = $r->biodata;
        if ($r->urlFoto != "") {
            $tentor->foto = $new_name;
        }
        $tentor->save();
    }



    public function showEditTentor(Request $request)
    {
        $id = $request->id;
        $tentor = tentorModel::where('idTentor', $id)
            ->first();

        if ($tentor != null) {
            $returnHTML = view('isipage.modalEditTentor')->with('tentor', $tentor)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data tentor akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deleteData(Request $request)
    {
        $tentor = tentorModel::find($request->idTentor);
        $tentor->delete();
    }
}
