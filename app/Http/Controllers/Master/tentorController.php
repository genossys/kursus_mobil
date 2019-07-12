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

    public function getDataTentor()
    {
        $tentor = tentorModel::query()
            ->select('idTentor', 'namaTentor', 'tanggalLahir', 'biodata', 'foto')
            ->get();

        return DataTables::of($tentor)
            ->addIndexColumn()
            ->addColumn('action', function ($tentor) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditTentor(\'' . $tentor->idTentor . '\',\'' . $tentor->namaTentor . '\', \'' . $tentor->tanggalLahir . '\', \'' . $tentor->biodata . '\', \'' . $tentor->foto . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $tentor->idTentor . '\', event)" ><i class="fa fa-trash"></i></a>
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
                $tentor = new tentorModel();
                $tentor->namaTentor = $r->namaTentor;
                $tentor->tanggalLahir = $r->tanggalLahir;
                $tentor->biodata = $r->biodata;
                $tentor->foto = $r->foto;
                $tentor->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $tentor
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
                $id = $r->idTentor;
                $data = [
                    'namaTentor' => $r->namaTentor,
                    'tanggalLahir' => $r->tanggalLahir,
                    'biodata' => $r->biodata,
                    'foto' => $r->foto,
                ];
                tentorModel::query()
                    ->where('idTentor', '=', $id)
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
        tentorModel::query()
            ->where('idTentor', '=', $id)
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
            $returnHTML = view('isipage.paketkosong')->with('kosong','Tentor yang anda cari tidak tersedia')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
