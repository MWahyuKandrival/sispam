<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string("id_transaksi", 20)->primary();
            $table->string("id_user", 20)->references('id')->on('users');
            // $table->foreign("id_user")->references("id_user")->on("users");
            $table->string("id_pelanggan", 20)->references('id')->on('pelanggans');
            // $table->foreign("id_pelanggan")->references("id_pelanggan")->on("pelanggan");
            $table->bigInteger("biaya_perkubik");
            // $table->foreign("biaya_perkubik")->references("biaya_perkubik")->on("hargas");
            $table->bigInteger("biaya_admin");
            // $table->foreign("biaya_admin")->references("biaya_admin")->on("biaya");
            $table->bigInteger("pemakaian");
            $table->bigInteger("total_tagihan");
            $table->bigInteger("total_pembayaran");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
