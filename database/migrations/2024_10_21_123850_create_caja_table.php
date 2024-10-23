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
        Schema::create('caja', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_efectivo', 8, 2); // Total en efectivo
            $table->decimal('total_debito', 8, 2); // Total en débito
            $table->decimal('total_transferencia', 8, 2); // Total en transferencias
            $table->decimal('total_ventas', 8, 2); // Total de todas las ventas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja');
    }
};
