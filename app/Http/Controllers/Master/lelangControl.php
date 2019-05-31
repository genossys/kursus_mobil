<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\lelangModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class lelangControl extends Controller
{
    //
    public function index(){
        return view('/admin/master/datalelang');
    }

    public function getDataLelang(){
        $lelang = lelangModel::query()
            ->select( 'idLelang', 'kdLelang', 'namaLelang', 'password', 'link', 'urlPenawaran', 'urlTeknis', 'urlKualifikasi' )
            ->orderBy( 'idLelang', 'ASC')
            ->get();
        
        return DataTables::of($lelang)
            ->addIndexColumn()
            ->addColumn('link', function ($lelang) {
                return '<a href="http://' . $lelang->link . '" target="_blank">'.$lelang->link.'<a/>';
            })
            ->addColumn('action', function ($lelang) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" 
                        onclick="showDetailLelang(\'' . $lelang->idLelang . '\',\'' . $lelang->kdLelang . '\',\'' . $lelang->namaLelang . '\',\'' . $lelang->password . '\',\'' . $lelang->link . '\',)"><i class="fa fa-edit"></i><a/> 
                        <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="deleteLelang(\''.$lelang->idLelang.'\')" ><i class="fa fa-trash"></i></a>
                        <a class="btn-sm btn-info details-control" id="btn-detail" href="#"><i class="fa fa-folder-open"></i></a>';
            })
            ->rawColumns(['link', 'action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'txtIdLelang' => 'required|max:10',
            'txtKodeLelang' => 'required|max:10',
            'txtNamaLelang' => 'required|max:255',
            'txtPswLelang' => 'required|max:50',
            'txtLinkWeb' => 'required|max:255'
        ];

        return Validator::make($r->all(), $rules, $messages);
    }


    public function insert(Request $r){
        
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            $idLelang = $r->txtIdLelang;
            
            if ($r->hasFile('filePenawaran')) {
                $upPenawaran = $r->file('filePenawaran');
                $namaPenawaran = 'PNW.'.$idLelang.'.'.$upPenawaran->getClientOriginalExtension();
                $r->filePenawaran->move(public_path('fpenawaran'),$namaPenawaran);
                # code...
            }else{
                $namaPenawaran = '';
            }

            if ($r->hasFile( 'fileTeknis')) {
                $upTeknis = $r->file( 'fileTeknis');
                $namaTeknis = 'TKN.' . $idLelang . '.' . $upTeknis->getClientOriginalExtension();
                $r->fileTeknis->move(public_path('fteknis'), $namaTeknis);
                # code...
            } else {
                $namaTeknis = '';
            }

            if ($r->hasFile( 'fileKualifikasi')) {
                $upKualifikasi = $r->file( 'fileKualifikasi');
                $namaKualifikasi = 'KLF.' . $idLelang . '.' . $upKualifikasi->getClientOriginalExtension();
                $r->fileKualifikasi->move(public_path('fkualifikasi'), $namaKualifikasi);
                # code...
            } else {
                $namaKualifikasi = '';
            }

            $lelang = new lelangModel;
            $lelang->idLelang = $r->txtIdLelang;
            $lelang->kdLelang = $r->txtKodeLelang;
            $lelang->namaLelang = $r->txtNamaLelang;
            $lelang->password = $r->txtPswLelang;
            $lelang->link = $r->txtLinkWeb;
            $lelang->urlPenawaran = $namaPenawaran;
            $lelang->urlTeknis = $namaTeknis;
            $lelang->urlKualifikasi = $namaKualifikasi;
            $lelang->save();

            return response()
                ->json([
                    'valid' => true,
                    'sukses' => $lelang,
                ]);
        }
    }

    private function isValidEdit(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'txtIdLelangEdit' => 'required|max:10',
            'txtKodeLelangEdit' => 'required|max:10',
            'txtNamaLelangEdit' => 'required|max:255',
            'txtPswLelangEdit' => 'required|max:50',
            'txtLinkWebEdit' => 'required|max:255'
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function update(Request $r){
        if ($this->isValidEdit($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this-> isValidEdit($r)->errors()->all()
            ]);
        } else {

            $oldIdLelang = $r->txtOldIdLelang;
            $idLelang = $r->txtIdLelangEdit;
            $data = [
                'idLelang' => $r->txtIdLelangEdit,
                'kdLelang' => $r->txtKodeLelangEdit,
                'namaLelang' => $r->txtNamaLelangEdit,
                'password' => $r->txtPswLelangEdit,
                'link' => $r->txtLinkWebEdit

            ];
            if ($r->hasFile('filePenawaranEdit')) {
                $upPenawaran = $r->file( 'filePenawaranEdit');
                $namaPenawaran = 'PNW.' . $idLelang . '.' . $upPenawaran->getClientOriginalExtension();
                $r->filePenawaranEdit->move(public_path('fpenawaran'), $namaPenawaran);
                $data = array_add($data, 'urlPenawaran', $namaPenawaran);
                # code...
            } else {
                $namaPenawaran = '';
            }

            if ($r->hasFile('fileTeknisEdit')) {
                $upTeknis = $r->file( 'fileTeknisEdit');
                $namaTeknis = 'TKN.' . $idLelang . '.' . $upTeknis->getClientOriginalExtension();
                $r->fileTeknisEdit->move(public_path('fteknis'), $namaTeknis);
                $data = array_add($data, 'urlTeknis', $namaTeknis);
                # code...
            } else {
                $namaTeknis = '';
            }

            if ($r->hasFile('fileKualifikasiEdit')) {
                $upKualifikasi = $r->file( 'fileKualifikasiEdit');
                $namaKualifikasi = 'KLF.' . $idLelang . '.' . $upKualifikasi->getClientOriginalExtension();
                $r->fileKualifikasiEdit->move(public_path('fkualifikasi'), $namaKualifikasi);
                $data = array_add($data, 'urlKualifikasi', $namaKualifikasi);
                # code...
            } else {
                $namaKualifikasi = '';
            }

            lelangModel::query()
                ->where('idLelang', '=', $oldIdLelang)
                ->update($data);

            return response()
                ->json([
                    'valid' => true,
                    'sukses' => $data,
                    'id' =>$oldIdLelang
                ]);
        }
    }

    public function delete(Request $r){
        $id = $r->input('idLelang');
        lelangModel::destroy($id);
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'url' => 'kelas/dataKelas'
        ]);
    }
}
