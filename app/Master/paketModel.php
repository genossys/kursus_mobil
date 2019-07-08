<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class paketModel extends Model
{
    //
    protected $table = 'tb_paket';
    protected $fillable = ['namaPaket', 'typeMobil', 'kaliPertemuan', 'jadwalBuka', 'jadwalTutup','harga'];
    public $timestamps = false;
}
