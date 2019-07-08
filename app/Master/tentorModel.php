<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class tentorModel extends Model
{
    //
    protected $table = 'tb_tentor';
    protected $fillable = ['namaTentor', 'tanggalLahir', 'biodata', 'foto'];
    public $timestamps = false;
}
