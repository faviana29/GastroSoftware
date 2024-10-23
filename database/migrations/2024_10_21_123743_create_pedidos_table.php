<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id(); // ID del pedido
            $table->unsignedBigInteger('usuario_id'); // ID del usuario que realizó el pedido
            $table->unsignedBigInteger('platillo_id'); // ID del platillo pedido
            $table->integer('cantidad'); // Cantidad del platillo
            $table->decimal('total', 10, 2); // Total del pedido
            $table->string('metodo_pago'); // Método de pago (efectivo, débito, transferencia)
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Definir las relaciones
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade'); // Relación con usuarios
            $table->foreign('platillo_id')->references('id')->on('platillos')->onDelete('cascade'); // Relación con platillos
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
