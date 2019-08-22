<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class transaksiModel extends Model
{
    //
    protected $table = 'tb_transaksi';
    protected $fillable = ['noTrans', 'total', 'tanggal', 'batasPembayaran','status_bayar','status_terima'];
    protected $primaryKey = 'noTrans';
    public $incrementing = false;
    public $timestamps = false;
}
