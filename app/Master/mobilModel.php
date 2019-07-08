<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class mobilModel extends Model
{
    //
    protected $table = 'tb_mobil';
    protected $fillable = ['merkMobil', 'typeMobil', 'tahun', 'noPol', 'gambar'];
    public $timestamps = false;
}
