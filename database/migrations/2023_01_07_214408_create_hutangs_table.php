<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->string("id_transaksi", 20)->references('id')->on('transaksis');;
            $table->bigInteger("jumlah");
            $table->string("status");
            $table->timestamps();
        });

        // Schema::table('hutangs', function (Blueprint $table) {
        //     $table->foreign("id_transaksi")->references("id_transaksi")->on("transaksis");
        // });

        // Schema::table('pelanggans', function (Blueprint $table) {
        //     $table->foreign('kode_mesin')->references('kode_mesin')->on('mesins');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hutangs');
    }
}
