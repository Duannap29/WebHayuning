<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Coin;

class CoinController extends Controller
{
    public function store(Request $request)
    {
    	$hargaCoin = $request->coin;
    	$stokCoin = 2000000;
    	$namaCoin = 'Qovar Coin';

    	Coin::create([
    		'nama' => $namaCoin,
    		'harga' => $hargaCoin,
    		'stok' => $stokCoin
    	]);

    	return redirect('home');
    }

    public function getCoin() {

        $getLastPrice = DB::table('coin')->orderBy('created_at', 'DESC')->limit(1)->get()->toJson();
        return $getLastPrice;
    }
}
