<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('gedung_id');
            $table->string('keperluan');
            $table->dateTime('awal_pinjam');
            $table->dateTime('akhir_pinjam');
            $table->string('surat_peminjaman');
            $table->bigInteger('lembaga_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
}
