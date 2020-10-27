<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmlelangFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmlelang_fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tmlelang_id')->unsigned();
            $table->foreign('tmlelang_id')->references('id')->on('tmlelangs')->onDelete('cascade');
            $table->string('foto');
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
        Schema::dropIfExists('tmlelang_fotos');
    }
}
