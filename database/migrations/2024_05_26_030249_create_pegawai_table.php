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
            $table->bigIncrements('id');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nohp');
            $table->string('email')->unique();
            $table->date('tanggal_masuk');
            $table->unsignedBigInteger('jabatan_id');
            $table->string('foto')->nullable();
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
