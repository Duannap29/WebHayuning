<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function nota(Request $request)
    {
    	$nama_pembeli = $request->nama_pembeli;
    	$alamat = $request->alamat;
    	$email = $request->email;
    	$no_KTP = $request->ktp;
    	$jumlah_beli = $request->pembelian;
    	$total_coin = $request->total_coin;

    	Transaksi::create([
    		'nama_pembeli' => $nama_pembeli,
    		'alamat' => $alamat,
    		'email' => $email,
    		'no_KTP' => $no_KTP,
    		'jumlah_beli' => $jumlah_beli,
    		'total_coin' => $total_coin
    	]);

    	return redirect('home');
    }
}
