<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class pembayaranModel extends Model
{
    //
    protected $table = 'tb_pembayaran';
    protected $fillable = ['noTrans', 'tanggal', 'bank', 'bukti'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
