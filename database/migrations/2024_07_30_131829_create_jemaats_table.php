<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->text('alamat');
            $table->string('jenis_kelamin', 15)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kota', 25)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('status_baptisan', 10)->nullable();
            $table->date('tanggal_baptisan')->nullable();
            $table->string('status_anggota', 15)->nullable();
            $table->timestamp('waktu_bergabung')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaat');
    }
}
