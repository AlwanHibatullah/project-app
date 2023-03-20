<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('nama_pegawai', 100);
            $table->string('status_kepegawaian', 10)->nullable();
            $table->integer('jabatan')->nullable();
            $table->string('nip', 20)->nullable();
            $table->integer('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
            $table->string('avatar', 100)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('kejuruan_id')->nullable();
            $table->foreign('kejuruan_id')->references('id')->on('kejuruan');
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
        Schema::dropIfExists('pegawai');
    }
}
