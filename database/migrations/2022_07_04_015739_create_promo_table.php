<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->id('id_promo');
            $table->foreignId('id_kedai')->references('id_kedai')->on('kedai')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_promo', 50);
            $table->string('foto', 100);
            $table->integer('potongan');
            $table->text('deskripsi');
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
        Schema::dropIfExists('promo');
    }
};
