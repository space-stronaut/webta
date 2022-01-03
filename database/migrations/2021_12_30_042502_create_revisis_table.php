<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidang_id');
            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade')->onUpdate('cascade');
            $table->text('komentar');
            $table->enum('status_revisi', ['proses', 'revisi', 'selesai'])->nullable();
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
        Schema::dropIfExists('revisis');
    }
}
