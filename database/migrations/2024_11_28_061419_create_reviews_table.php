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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('book_id') 
                ->constrained('books') 
                ->onDelete('cascade'); 
            $table->foreignId('user_id') 
                ->constrained('users') 
                ->onDelete('cascade');
            $table->text('review_text');
            $table->json('tags'); 
            $table->timestamp('review_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
