<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pembeli');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_KTP');
            //$table->bigInteger('coin_id')->unsigned();
            //$table->Date('Tgl_pembelian');
            //$table->string('alamat');
            $table->string('jumlah_beli');
            $table->string('total_coin');

            $table->timestamps();
            //$table->foreign('pembeli_id')->references('id')->on('pembeli')->onDelete('cascade');
            //$table->foreign('coin_id')->references('id')->on('coin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
