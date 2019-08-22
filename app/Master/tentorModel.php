<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class tentorModel extends Model
{
    //
    protected $table = 'tb_tentor';
    protected $fillable = ['namaTentor', 'tanggalLahir', 'biodata', 'foto'];
    protected $primaryKey = 'idTentor';
    public $timestamps = false;
}
