<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Master\tentorModel;
use App\Master\mobilModel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome()
    {

        $tentor = tentorModel::all();
        $mobil = mobilModel::all();
        return view('umum.welcome')->with(['tentor' => $tentor, 'mobil' => $mobil]);
    }
}
