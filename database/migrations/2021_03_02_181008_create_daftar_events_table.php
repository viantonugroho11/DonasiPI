<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->length(20)->nullable();
            $table->string('nama')->length(50);
            $table->string('email')->unique();
            $table->bigInteger('nohp')->length(14)->nullable();
            $table->bigInteger('id_event')->length(20);
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
        Schema::dropIfExists('daftar_events');
    }
}
