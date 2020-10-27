<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeleksijptTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            //--- Tabel Lelang (3)
        Schema::create('tmlelangs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->string('n_lelang', 100);
            $table->longText('ket');
            $table->date('d_dari');
            $table->date('d_sampai');
            $table->boolean('c_status');
            $table->timestamps();

            $table->foreign('opd_id')
                ->references('id')
                ->on('opds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('tmsyarats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_syarat', 150);
            $table->string('ket', 200);
            $table->timestamps();
        });

        Schema::create('trlelang_syarats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmlelang_id');
            $table->unsignedInteger('tmsyarat_id');
            $table->integer('no_urut')->unsigned();
            $table->boolean('c_status');
            $table->timestamps();

            $table->foreign('tmlelang_id')
                ->references('id')
                ->on('tmlelangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tmsyarat_id')
                ->references('id')
                ->on('tmsyarats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

            //--- Tabel Pelamar Lelang (5)
        Schema::create('tmpelamar_statuss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_status', 30);
            $table->string('ket', 200);
            $table->timestamps();
        });

        Schema::create('tmregistrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip', 25)->unique();
            $table->string('password', 90);
            $table->string('email', 50);
            $table->string('n_pegawai', 50);
            $table->string('telp', 20);
            $table->string('alamat', 100);
            $table->string('n_unitkerja', 50);
            $table->string('n_opd', 50);
            $table->string('nik', 18)->unique();
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
            $table->boolean('c_tangsel');
            $table->timestamps();

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

        Schema::create('tmpelamars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmregistrasi_id');
            $table->unsignedInteger('tmpelamar_status_id');
            $table->unsignedInteger('tmlelang_id');
            $table->string('no_pendaftaran', 20)->nullable();
            $table->unsignedInteger('panselnas_id')->nullable();
            $table->boolean('c_panselnas')->nullable();
            $table->date('d_panselnas')->nullable();
            $table->string('n_panselnas', 50)->nullable();
            $table->boolean('c_admin')->nullable();
            $table->date('d_admin')->nullable();
            $table->boolean('c_tolak')->nullable();
            $table->longText('alasan_tolak')->nullable();
            $table->dateTime('d_kesehatan_dari')->nullable();
            $table->dateTime('d_kesehatan_sampai')->nullable();
            $table->dateTime('d_assesment_dari')->nullable();
            $table->dateTime('d_assesment_sampai')->nullable();
            $table->dateTime('d_wawancara_dari')->nullable();
            $table->dateTime('d_wawancara_sampai')->nullable();
            $table->timestamps();

            $table->foreign('tmregistrasi_id')
                ->references('id')
                ->on('tmregistrasis')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tmpelamar_status_id')
                ->references('id')
                ->on('tmpelamar_statuss')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tmlelang_id')
                ->references('id')
                ->on('tmlelangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('trpelamar_syarats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmpelamar_id');
            $table->unsignedInteger('tmsyarat_id');
            $table->string('file', 100);
            $table->timestamps();

            $table->foreign('tmpelamar_id')
                ->references('id')
                ->on('tmpelamars')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tmsyarat_id')
                ->references('id')
                ->on('tmsyarats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('tmmutasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmpelamar_id');
            $table->string('catatan', 200);
            $table->unsignedInteger('pegawai_dari_id');
            $table->unsignedInteger('pegawai_ked_id');
            $table->string('i_entry', 200);
            $table->boolean('c_terima');
            $table->timestamps();

            $table->foreign('tmpelamar_id')
                ->references('id')
                ->on('tmpelamars')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });


            //--- Tabel Pelengkap (6)
        Schema::create('tmagendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_agenda', 100);
            $table->longText('ket');
            $table->boolean('c_status');
            $table->date('d_dari');
            $table->date('d_sampai');
            $table->timestamps();
        });

        Schema::create('tmpengumumans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_pengumuman', 100);
            $table->longText('ket');
            $table->boolean('c_status');
            $table->date('tgl');
            $table->timestamps();
        });

        Schema::create('tmcontents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link', 30);
            $table->string('n_content', 100);
            $table->longText('ket');
            $table->boolean('c_status');
            $table->timestamps();
        });

        Schema::create('tmfiledownloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_filedownload', 100);
            $table->string('ket', 200);
            $table->string('file', 100);
            $table->boolean('c_status');
            $table->timestamps();
        });

        Schema::create('tmalbums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_album', 50);
            $table->string('ket', 200);
            $table->boolean('c_status');
            $table->timestamps();
        });

        Schema::create('tmalbumfotos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmalbum_id');
            $table->integer('no_urut')->unsigned();
            $table->string('img', 100);
            $table->string('ket', 200);
            $table->boolean('c_status');
            $table->timestamps();

            $table->foreign('tmalbum_id')
                ->references('id')
                ->on('tmalbums')
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
            //--- Tabel Lelang (3)
        Schema::dropIfExists('tmlelangs');
        Schema::dropIfExists('tmsyarats');
        Schema::dropIfExists('trlelang_syarats');

            //--- Tabel Pelamar Lelang (5)
        Schema::dropIfExists('tmpelamar_statuss');
        Schema::dropIfExists('tmregistrasis');
        Schema::dropIfExists('tmpelamars');
        Schema::dropIfExists('trpelamar_syarats');
        Schema::dropIfExists('tmmutasis');

            //--- Tabel Pelengkap (6)
        Schema::dropIfExists('tmagendas');
        Schema::dropIfExists('tmpengumumans');
        Schema::dropIfExists('tmcontents');
        Schema::dropIfExists('tmfiledownloads');
        Schema::dropIfExists('tmalbums');
        Schema::dropIfExists('tmalbumfotos');
        
    }
}
