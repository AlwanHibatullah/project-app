<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('ijazah', 100);
            $table->string('transkip', 100);
            $table->string('surat_pernyataan', 100);
            $table->string('foto', 100);
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('buku_induk');
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
        Schema::dropIfExists('dokumen');
    }
}
