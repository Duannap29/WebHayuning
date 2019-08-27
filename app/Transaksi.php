<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $table = "transaksi";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_pembeli', 'alamat', 'email','no_KTP','jumlah_beli', 'total_coin'];
}
