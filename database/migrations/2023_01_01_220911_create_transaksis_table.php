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
            $table->string("id", 20)->primary();
            $table->string("id_pemakaian", 20)->references('id')->on('pemakaians');
            $table->bigInteger("total_pembayaran");
            $table->string("created_by", 20)->references('id')->on('users');
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
