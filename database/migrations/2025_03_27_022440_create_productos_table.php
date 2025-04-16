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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('producto')->nullable();
            $table->string('imagen')->nullable();
            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('categoria_id')->nullable();
            $table->integer('precio_con_iva')->nullable();
            $table->integer('precio_sin_iva')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
