<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golongans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_golongan', 50);
            $table->string('ket', 100);
            $table->timestamps();
        });

        Schema::create('eselons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_eselon', 50);
            $table->string('ket', 250);
            $table->timestamps();
        });

        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('nik', 18);
            $table->string('t_lahir', 30);
            $table->string('d_lahir', 30);
            $table->string('jk', 11);
            $table->string('pekerjaan', 30);
            $table->unsignedInteger('kelurahan_id');
            $table->unsignedInteger('golongan_id');
            $table->date('tmt_golongan')->nullable();
            $table->unsignedInteger('eselon_id');
            $table->date('tmt_eselon')->nullable();
            $table->string('jabatan', 50);
            $table->string('instansi', 50);
            $table->string('foto', 50)->nullable();

            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('kelurahans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('golongan_id')
                ->references('id')
                ->on('golongans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('eselon_id')
                ->references('id')
                ->on('eselons')
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
        Schema::dropIfExists('golongans');
        Schema::dropIfExists('eselons');
    }
}
