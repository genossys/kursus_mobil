<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class jadwalModel extends Model
{
    //
    protected $table = 'tb_jadwal';
    protected $fillable = ['tanggal', 'waktu', 'usernameCustomer'];
    protected $primaryKey = 'idJadwal';
    public $timestamps = false;
}
