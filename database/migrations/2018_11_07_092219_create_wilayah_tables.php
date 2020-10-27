<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWilayahTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinsis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 3);
            $table->string('n_provinsi', 30);
            $table->timestamps();
        });

        Schema::create('kabupatens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 6);
            $table->string('n_kabupaten', 50);
            $table->unsignedInteger('provinsi_id');
            $table->timestamps();

            $table->foreign('provinsi_id')
                ->references('id')
                ->on('provinsis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kecamatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 9);
            $table->string('n_kecamatan', 50);
            $table->unsignedInteger('kabupaten_id');
            $table->timestamps();

            $table->foreign('kabupaten_id')
                ->references('id')
                ->on('kabupatens')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kelurahans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 14);
            $table->string('n_kelurahan', 50);
            $table->unsignedInteger('kecamatan_id');
            $table->timestamps();

            $table->foreign('kecamatan_id')
                ->references('id')
                ->on('kecamatans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
