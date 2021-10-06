<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->length(50);
            $table->bigInteger('id_kategori')->length(20)->nullable();
            $table->bigInteger('id_admin')->length(20);
            $table->longtext('detail');
            $table->string('detail_singkat')->length(255);
            $table->string('foto')->length(50);
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
        Schema::dropIfExists('artikels');
    }
}
