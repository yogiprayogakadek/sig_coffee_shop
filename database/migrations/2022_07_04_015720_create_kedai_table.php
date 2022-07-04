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
        Schema::create('kedai', function (Blueprint $table) {
            $table->id('id_kedai');
            $table->string('nama_kedai', 50);
            $table->string('alamat_kedai', 100);
            $table->string('foto', 100);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
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
        Schema::dropIfExists('kedai');
    }
};
