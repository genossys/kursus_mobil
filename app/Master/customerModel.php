<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class customerModel extends Model
{
    //
    protected $table = 'tb_customer';
    protected $fillable = ['id','username', 'email', 'password', 'nohp', 'alamat'];
    protected $primaryKey = 'id';
}
