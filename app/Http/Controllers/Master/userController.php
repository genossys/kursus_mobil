<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.datauser');
    }

    public function getDataUser()
    {
        $user = User::query()
            ->select('id', 'username', 'email', 'hakAkses', 'noHp')
            ->get();

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<a class="btn-sm btn-warning" data-toggle="tooltip" title="Ganti Data" id="btn-edit" href="#" onclick="showEditUser(\'' . $user->username . '\',\'' . $user->email . '\',\'' . $user->hakAkses . '\', \'' . $user->noHp . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-info" data-toggle="tooltip" title="Ganti Password" id="btn-delete" href="#" onclick="showEditPassowrd(\'' . $user->username . '\', event)" ><i class="fa fa-key" aria-hidden="true"></i></a>
                            <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $user->username . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'username' => 'required|max:191|unique:tb_user,username',
            'email' => 'required|max:191',
            'nohp' => 'required|numeric|digits_between:1,15',
            'password' => 'required|string|min:8|confirmed',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function addUser(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            try {
                $user = new User();
                $user->username = $r->username;
                $user->email = $r->email;
                $user->password = Hash::make($r->password);
                $user->nohp = $r->nohp;
                $user->hakAkses = $r->hakAkses;
                $user->save();
                return response()->json([
                    'sqlResponse' => true,
                    'data' => $user,
                    'valid' => true
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'sqlResponse' => false,
                    'data' => $th,
                    'valid' => true
                ]);
            }
        }
    }

    private function isValidEdit(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'usernameedit' => 'required|max:191|',
            'emailedit' => 'required|max:191',
            'nohpedit' => 'required|numeric|digits_between:1,15',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function editUser(Request $r)
    {
        if ($this->isValidEdit($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValidEdit($r)->errors()->all()
            ]);
        } else {
            try {
                $id = $r->oldusername;
                $data = [
                    'username' => $r->usernameedit,
                    'email' => $r->emailedit,
                    'nohp' => $r->nohpedit,
                    'hakAkses' => $r->hakAksesedit
                ];
                User::query()
                    ->where('username', '=', $id)
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

    private function isValidPassword(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'passwordedit' => 'required|min:8|confirmed',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function editPassword(Request $r)
    {

        if ($this->isValidPassword($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValidPassword($r)->errors()->all()
            ]);
        } else {
            try {
                $id = $r->oldusernamepsw;
                $data = [
                    'password' => Hash::make($r->passwordedit),
                ];
                User::query()
                    ->where('username', '=', $id)
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
        User::query()
            ->where('username', '=', $id)
            ->delete();;
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'data' => 'tahapan/dataTahapan',
            'sqlResponse' => true,
        ]);
    }
}
