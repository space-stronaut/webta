<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sidang')->nullable();
            $table->date('tanggal_sidang');
            $table->unsignedBigInteger('dosen_id');
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['proses', 'disetujui', 'revisi']);
            $table->unsignedBigInteger('paa_id');
            $table->foreign('paa_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pengaju_id');
            $table->foreign('pengaju_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('judul_ta');
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
        Schema::dropIfExists('sidangs');
    }
}
