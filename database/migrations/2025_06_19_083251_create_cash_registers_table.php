<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_create_cash_registers_table.php

public function up(): void
{
    Schema::create('cash_registers', function (Blueprint $table) {
        $table->id();
        $table->date('date'); // ESTA LÍNEA ES IMPORTANTE
        $table->decimal('opening_cash', 10, 2)->default(0);
        $table->decimal('opening_gold', 10, 2)->default(0);  // gramos
        $table->decimal('opening_silver', 10, 2)->default(0); // gramos
        $table->decimal('closing_cash', 10, 2)->nullable();
        $table->decimal('closing_gold', 10, 2)->nullable();
        $table->decimal('closing_silver', 10, 2)->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_registers');
    }
};
