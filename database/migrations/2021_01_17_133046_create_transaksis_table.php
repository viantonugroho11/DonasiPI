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
            $table->id();
            $table->biginteger('orderid')->length(20);
            $table->string('transaksiid')->length(50);
            $table->bigInteger('id_program')->length(20)->nullable();
            $table->bigInteger('id_user')->length(20);
            $table->string('nama')->length(50);
            $table->string('tipe',15)->length(15);
            $table->string('pesan')->nullable();
            $table->bigInteger('nominal')->length(10);
            $table->string('status')->length(20);
            $table->string('jenis')->length(10);
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
