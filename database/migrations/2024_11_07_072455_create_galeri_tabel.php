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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_galeri');
            $table->string('galeri_seo')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto');
            $table->unsignedBigInteger('books_id');
            $table->foreign('books_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
            $table->timestamps();
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
