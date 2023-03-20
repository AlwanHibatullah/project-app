<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paketpelatihan', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('namapelatihan', 100);
            $table->string('group', 1000)->nullabel();
            $table->integer('angkatan');
            $table->integer('jp');
            $table->date('test');
            $table->date('awalpelatihan');
            $table->date('selesaipelatihan');
            $table->date('pembukaan');
            $table->date('penutupan');
            $table->integer('tahun');
            $table->integer('jumlah_siswa');
            $table->integer('status');
            $table->unsignedBigInteger('dana_id');
            $table->foreign('dana_id')->references('id')->on('dana');
            $table->unsignedBigInteger('jpelatihan_id');
            $table->foreign('jpelatihan_id')->references('id')->on('jpelatihan');
            $table->unsignedBigInteger('subkejuruan_id');
            $table->foreign('subkejuruan_id')->references('id')->on('subkejuruan');
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
        Schema::dropIfExists('paket_pelatihan');
    }
}
