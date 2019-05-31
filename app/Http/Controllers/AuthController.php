<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    function postlogin(Request $request){
        if(Auth::attempt($request->only('user_id','password'))){
            return redirect('/admin');
        }else {
            return redirect()->back()->with('gagal','user id/password salah');

        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }

    public function login()
    {
        return view('umum.login');
    }
}
