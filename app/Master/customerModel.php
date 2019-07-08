<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class customerModel extends Model
{
    //
    protected $table = 'tb_customer';
    protected $fillable = ['username', 'email', 'password', 'nohp', 'alamat'];
}
