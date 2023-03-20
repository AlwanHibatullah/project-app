<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('predikat', 100);
            $table->string('no_sertifikat', 100)->unique();
            $table->string('file_sertifikat', 100);
            $table->text('bekerja_di');
            $table->text('pesan');
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
        Schema::dropIfExists('alumni');
    }
}
