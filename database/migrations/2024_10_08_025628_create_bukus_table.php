<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('penulis_id');
            $table->integer('tahun_terbit');
            $table->string('penerbit');
            $table->string('jenis');
            $table->text('sinopsis');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('penulis_id')->references('id')->on('penulis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
