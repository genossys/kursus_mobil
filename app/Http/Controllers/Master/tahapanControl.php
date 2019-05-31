<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\tahapanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class tahapanControl extends Controller
{
    public function index(){
        return view('/admin/master/datatahapan');
    }

    public function getDataTahapan(){
        $tahapan = tahapanModel::query()
                ->select('idTahapan','idLelang','batasUpload','pekerjaan')
                ->orderBy('idTahapan', 'ASC')
                ->get();
        return Datatables::of($tahapan)
            ->addIndexColumn()
            ->addColumn( 'action', function ($tahapan) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showDetail(\'' . $tahapan->idTahapan . '\',\'' . $tahapan->idLelang . '\',\'' . $tahapan->batasUpload . '\',\'' . $tahapan->pekerjaan . '\')"><i class="fa fa-edit"></i><a/>
                        <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="deleteTahapan(\''. $tahapan->idTahapan.'\')" ><i class="fa fa-trash"></i></a>';
                })
            ->make(true);


    }

    private function isValid(Request $r){
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'txtIdTahapan' => 'required|max:10',
            'txtIdLelang' => 'required|max:10',
            'txtPekerjaan' => 'required',
            'dateBatasUp' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    private function isValidEdit(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'txtIdTahapanEdit' => 'required|max:10',
            'txtIdLelangEdit' => 'required|max:10',
            'txtPekerjaanEdit' => 'required',
            'dateBatasUpEdit' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function insert(Request $r){

        if ($this-> isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this-> isValid($r)->errors()->all()
            ]);
        } else {
            $tahapan = new tahapanModel();
            $tahapan->idTahapan = $r->txtIdTahapan;
            $tahapan->idLelang = $r->txtIdLelang;
            $tahapan->pekerjaan = $r->txtPekerjaan;
            $tahapan->batasUpload = $r->dateBatasUp;
            $tahapan->save();
            return response()
                ->json([
                    'valid' => true,
                    'sukses' => $tahapan
                ]);
        }
    }

    public function update(Request $r){

        if ($this->isValidEdit($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValidUpdate($r)->errors()->all()
            ]);
        } else {
            $id = $r->txtOldIdTahapan;
            $data = [
                'idTahapan' => $r->txtIdTahapanEdit,
                'idLelang' => $r->txtIdLelangEdit,
                'pekerjaan' => $r->txtPekerjaanEdit,
                'batasUpload' => $r->dateBatasUpEdit
            ];
            tahapanModel::query()
                ->where('idTahapan', '=', $id)
                ->update($data);
            return response()
                ->json([
                    'valid' => true,
                    'sukses' => $data,
                    'url' => 'tahapan/dataTahapan'
                ]);
        }
    }

    public function delete(Request $r){
        $id = $r->input('idTahapan');
        tahapanModel::destroy($id);
        return response()->json([
            'sukses' => 'Berhasil Di hapus'. $id,
            'url' => 'tahapan/dataTahapan'
        ]);
    }
}
