<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('noinduk',100)->nullable();
            $table->string('nama_pendaftar', 100);
            $table->string('nik', 100)->unique();
            $table->string('tempat_lahir', 100);
            $table->date('tgl_lahir');
            $table->integer('jenis_kelamin');
            $table->integer('status_pernikahan');
            $table->string('telp', 20);
            $table->string('telpwali', 20);
            $table->string('email', 100);
            $table->integer('bb');
            $table->integer('tb');
            $table->integer('status_ktp');
            $table->integer('ktp');
            $table->string('orangtua', 100);
            $table->text('alamat_detail');
            $table->integer('pendidikan_terakhir');
            $table->text('nama_sekolah');
            $table->text('jurusan_prodi');
            $table->integer('tahun_lulus');
            $table->float('nilai_rata', 8, 2);
            $table->unsignedBigInteger('paketpelatihan_id');
            $table->foreign('paketpelatihan_id')->references('id')->on('paketpelatihan');
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
        Schema::dropIfExists('riwayat');
    }
}
