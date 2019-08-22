<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class pesananModel extends Model
{
    //
    protected $table = 'tb_pesanan';
    protected $fillable = ['noTrans', 'idPaket', 'usernameCustomer', 'harga', 'tanggal','checkout','status_bayar','status_terima','batasPembayaran'];
    public $timestamps = false;
}
