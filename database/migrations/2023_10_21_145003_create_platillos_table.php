<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->id(); // ID del platillo
            $table->string('nombre'); // Nombre del platillo
            $table->decimal('precio', 10, 2); // Precio del platillo
            $table->text('descripcion')->nullable(); // Descripción del platillo
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platillos');
    }
}

