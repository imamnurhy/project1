<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumpuns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_rumpun', 10);
            $table->string('ket', 100);
            $table->timestamps();
        });

        Schema::create('opds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 10);
            $table->string('n_opd', 100);
            $table->string('initial', 50);
            $table->unsignedInteger('rumpun_id');
            $table->timestamps();
        });
        
        Schema::create('unitkerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_unitkerja', 50);
            $table->string('initial', 10)->nullable();
            $table->unsignedInteger('opd_id');
            $table->timestamps();

            $table->foreign('opd_id')
                ->references('id')
                ->on('opds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip', 25)->unique();;
            $table->string('n_pegawai', 30);
            $table->string('telp', 20);
            $table->string('alamat', 100);
            $table->unsignedInteger('unitkerja_id');
            $table->unsignedInteger('opd_id');
            $table->integer('user_id')->nullable();
            $table->timestamps();

            $table->foreign('unitkerja_id')
                ->references('id')
                ->on('unitkerjas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('opd_id')
                ->references('id')
                ->on('opds')
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
        Schema::dropIfExists('unitkerjas');
        Schema::dropIfExists('opds');
        Schema::dropIfExists('rumpuns');
        Schema::dropIfExists('pegawais');
    }
}
