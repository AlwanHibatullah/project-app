<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkkniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skkni', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('kode_unit', 100);
            $table->string('unit_kompetensi', 100);
            $table->integer('jp_teori');
            $table->integer('jp_praktik');
            $table->integer('kelompok_unit');
            $table->unsignedBigInteger('subkejuruan_id');
            $table->foreign('subkejuruan_id')->references('id')->on('subkejuruan');
            $table->unsignedBigInteger('dana_id');
            $table->foreign('dana_id')->references('id')->on('dana');
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
        Schema::dropIfExists('skkni');
    }
}
