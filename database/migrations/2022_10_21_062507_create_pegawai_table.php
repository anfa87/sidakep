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
            $table->id();
            $table->char('kd_pegawai',13)->unique();
            $table->char('nik',16)->unique();
            $table->string('pas_foto');
            $table->string('nama',100);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->char('no_hp',13);
            $table->date('tanggal_masuk');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']);
            $table->string('alamat');
            $table->string('ktp');
            $table->string('kk');
            $table->string('akta_lahir');
            $table->string('cv');
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
