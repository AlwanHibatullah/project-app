<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubkejuruanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subkejuruan', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->string('kode_subkejuruan', 100);
            $table->string('subkejuruan', 100);
            $table->text('deskripsi');
            $table->string('thumnail', 100);
            $table->unsignedBigInteger('kejuruan_id');
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
        Schema::dropIfExists('subkejuruan');
    }
}
