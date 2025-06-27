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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('metal_type', ['oro', 'plata']);
            $table->decimal('grams', 8, 2);
            $table->decimal('purity', 5, 2)->nullable(); // opcional
            $table->decimal('price_per_gram', 10, 2);
            $table->string('image_path')->nullable(); // para la imagen
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
