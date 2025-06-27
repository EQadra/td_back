<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_create_transactions_table.php

  public function up(): void
  {
      Schema::create('transactions', function (Blueprint $table) {
          $table->id();
          $table->foreignId('cash_register_id')->constrained()->onDelete('cascade');
          //----------------------------------------------------------------------------//
          $table->enum('type', ['compra', 'venta']); // 🔴 ESTA ES LA COLUMNA QUE FALTA
          $table->enum('metal_type', ['oro', 'plata']); // tipo de metal
          $table->decimal('grams', 10, 2); // cantidad en gramos
          $table->decimal('price_per_gram', 10, 2); // precio por gramo
          $table->decimal('total_pen', 10, 2);
          $table->decimal('total_usd', 10, 2);
          $table->decimal('exchange_rate', 10, 3);
  
          $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
  
          $table->timestamps();
      });
  }
  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
