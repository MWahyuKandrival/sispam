<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->string("id", 20)->primary();
            $table->string("id_user", 20)->references('id')->on('users');
            $table->string("id_pelanggan", 20)->references('id')->on('pelanggans');
            $table->date("tanggal");
            $table->bigInteger("biaya_perkubik");
            $table->bigInteger("biaya_admin");
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
        Schema::dropIfExists('pemakaians');
    }
}
