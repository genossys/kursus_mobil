<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.datauser');
    }

    public function insert(Request $r)
    {
        $user = new User();
        $user->username = $r->username;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->hakAkses = $r->hakAkses;
        $user->save();
    }

    public function showUser(Request $request)
    {
        $caridata = $request->caridata;
        $user = User::where('username', 'LIKE', '%' . $caridata . '%')
            ->orwhere('email', 'LIKE', '%' . $caridata . '%')
            ->orwhere('hakAkses', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $user->first();

        if ($contoh != null) {
            $returnHTML = view('isipage.tabelUser')->with('user', $user)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data user akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }


    public function edit(Request $r)
    {

        $user = User::find($r->id);
        $user->username = $r->username;
        $user->email = $r->email;
        $user->hakAkses = $r->hakAkses;
        $user->save();
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'merkUser' => 'required:tb_user',
            'typeUser' => 'required|max:30',
            'tahun' => 'required|max:4',
            'noPol' => 'required|max:12|unique:tb_user',
            'gambar' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }



    public function showEditUser(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)
            ->first();

        if ($user != null) {
            $returnHTML = view('isipage.modalEditUser')->with('user', $user)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isipage.datakosong')->with('kosong', 'Data user akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function deleteData(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
    }
}
