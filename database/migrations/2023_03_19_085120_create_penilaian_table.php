<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->integer('jenis_nilai');
            $table->integer('nilai');
            $table->unsignedBigInteger('skkni_id');
            $table->foreign('skkni_id')->references('id')->on('skkni');
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('buku_induk');
            // $table->unsignedBigInteger('pagawai_id');
            // $table->foreign('pagawai_id')->references('id')->on('pegawai');
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
        Schema::dropIfExists('penilaian');
    }
}
