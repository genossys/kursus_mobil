<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Master\jadwalModel;
use App\Master\pesananModel;
use DateTimeImmutable;
use Illuminate\Foundation\Auth\RegistersUsers;

class jadwalController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        $jadwal = jadwalModel::where('usernameCustomer',auth()->user()->username)->get();
        return view('umum.jadwalkursus')->with('jadwal',$jadwal);
    }

    public function laporanJadwal()
    {
        return view('admin.laporan.laporanJadwal');
    }

    public function insert(Request $r)
    {
        $pesanan = pesananModel::join('tb_paket', 'tb_pesanan.idPaket', 'tb_paket.idPaket')
        ->where('noTrans', $r->noTrans)
        ->first();

        $kaliPertemuan = $pesanan->kaliPertemuan;
        $tanggal = new DateTimeImmutable($r->reqTglMulai);

        $i = 0;
        while ($kaliPertemuan > $i) {
            $jadwal = new jadwalModel();
            $jadwal->tanggal = $tanggal;
            $jadwal->waktu = $pesanan->reqWaktu;
            $jadwal->usernameCustomer = $pesanan->usernameCustomer;
            $jadwal->noTrans = $pesanan->noTrans;
            $jadwal->save();

            $tanggal = $tanggal->modify('+1 day');
            $i++;
        }
    }

    public function showJadwal(Request $request)
    {
        $caridata = $request->caridata;
        $state = $request->state;
        $jadwal = jadwalModel::where('merkJadwal', 'LIKE', '%' . $caridata . '%')
            ->orwhere('typeJadwal', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tahun', 'LIKE', '%' . $caridata . '%')
            ->orwhere('noPol', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $jadwal->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabelJadwal')->with(['jadwal' => $jadwal, 'state' => $state])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data jadwal akan Tampil di sini ')->render();
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
            $new_name = $r->merkJadwal . rand() . '.' . $urlFoto->getClientOriginalExtension();
            $urlFoto->move(public_path('jadwal'), $new_name);
        } else { }

        $jadwal = jadwalModel::find($r->idJadwal);
        $jadwal->merkJadwal = $r->merkJadwal;
        $jadwal->typeJadwal = $r->typeJadwal;
        $jadwal->tahun = $r->tahun;
        $jadwal->noPol = $r->noPol;
        if ($r->urlFoto != "") {
            $jadwal->gambar = $new_name;
        }
        $jadwal->save();
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'merkJadwal' => 'required:tb_jadwal',
            'typeJadwal' => 'required|max:30',
            'tahun' => 'required|max:4',
            'noPol' => 'required|max:12|unique:tb_jadwal',
            'gambar' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }


    public function pencarianJadwal(Request $request)
    {
        $state = $request->state;
        $cariJadwal = $request->cariJadwal;
        $dataJadwal = jadwalModel::where('merkJadwal', 'LIKE', "%" . $cariJadwal . "%")
            ->orwhere('typeJadwal', 'LIKE', "%" . $cariJadwal . "%")
            ->orwhere('tahun', 'LIKE', "%" . $cariJadwal . "%")
            ->get();
        $contoh = $dataJadwal->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.pencarianjadwal')->with(['dataJadwal' => $dataJadwal, 'state' => $state])->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.paketkosong')->with('kosong', 'Jadwal yang anda cari tidak tersedia')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showEditJadwal(Request $request)
    {
        $id = $request->id;
        $jadwal = jadwalModel::where('idJadwal', $id)
            ->first();

        if ($jadwal != null) {
            $returnHTML = view('isipage.modalEditJadwal')->with('jadwal', $jadwal)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data jadwal akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deleteData(Request $request)
    {
        $jadwal = jadwalModel::find($request->idJadwal);
        $jadwal->delete();
    }
}
