<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\coin;
use App\transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coins = Coin::all();
        $coinnew = DB::table('coin')->orderBy('id','desc')->first();
        $transaksis = Transaksi::all();
        $totalTransaksi = DB::table('transaksi')->select(DB::raw("SUM(jumlah_beli)as total_idr, SUM(total_coin) as total_pembelian_coin"))->get();
        return view('home', compact('coins','coinnew','transaksis','totalTransaksi'));
    }

}
