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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // quien califica
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // producto calificado
            $table->unsignedTinyInteger('score'); // 1 a 5
            $table->text('comment')->nullable();
            $table->timestamps();
        
            $table->unique(['user_id', 'product_id']); // Solo una calificación por usuario por producto
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
