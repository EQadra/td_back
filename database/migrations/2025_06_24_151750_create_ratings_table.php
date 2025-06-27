<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Polimórfico: rateable_id y rateable_type
            $table->unsignedBigInteger('rateable_id');
            $table->string('rateable_type');

            $table->unsignedTinyInteger('score'); // 1 a 5
            $table->text('comment')->nullable();

            $table->timestamps();

            // Asegurar que solo una calificación por usuario por entidad
            $table->unique(['user_id', 'rateable_id', 'rateable_type']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('ratings');
    }
};
