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
        Schema::create('producto_sede', function (Blueprint $table) {
            $table->id('idProductoSede');
            $table->foreignId('producto')->constrained('productos', 'idProducto');
            $table->foreignId('sede')->constrained('sedes', 'idSede');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_sede');
    }
};
