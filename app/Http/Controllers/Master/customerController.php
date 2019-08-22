<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\customerModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class customerController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.master.datacustomer');
    }

    public function showFormRegistrasi()
    {
        $this->middleware('guest');
        return view('auth.registermember');
    }

    public function getDataCustomer()
    {
        $customer = customerModel::query()
            ->select('username', 'email', 'password', 'nohp', 'alamat')
            ->get();

        return DataTables::of($customer)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                return '<a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $customer->username . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function register(Request $r)
    {
        $this->middleware('guest');
        if ($this->isValid($r)->fails()) {
            return redirect()->back()->withErrors( $this->isValid($r)->errors()->all()) ;
        } else{
            try {
                $member = new customerModel();
                $member->username = $r->username;
                $member->email = $r->email;
                $member->password = Hash::make($r->password);
                $member->nohp = "62".$r->nohp;
                $member->alamat = $r->alamat;
                $member->save();
                $credentials = $r->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('/');
                } else {
                    return redirect()->back();
                }
            } catch (\Throwable $th) {
                return 'Error Program ' . $th;
            }
        }


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
                $member = new customerModel();
                $member->username = $r->username;
                $member->email = $r->email;
                $member->password = Hash::make($r->password);
                $member->nohp = $r->nohp;
                $member->alamat = $r->alamat;
                $member->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $member
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
                $id = $r->oldusername;
                $data = [
                    'username' => $r->username,
                    'email' => $r->email,
                    'nohp' => $r->nohp,
                    'alamat' => $r->alamat,
                ];
                customerModel::query()
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
        customerModel::query()
            ->where('username', '=', $id)
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
            'username' => 'required|max:50|unique:tb_customer',
            'email' => 'required|max:255|unique:tb_customer',
            'password' => 'required|min:5|confirmed',
            'nohp' => 'required|numeric|digits_between:1,15',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
}
