<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
     protected $table = "coin";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'harga', 'stok'];
}
