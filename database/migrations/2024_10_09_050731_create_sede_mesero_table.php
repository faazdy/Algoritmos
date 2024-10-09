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
        Schema::create('sede_meseros', function (Blueprint $table) {
            $table->id('idSedeMesero');
            $table->foreignId('sede')->constrained('sedes', 'idSede'); // Especificar el nombre de la columna de la clave primaria
            $table->foreignId('mesero')->constrained('meseros', 'idMesero'); // Asegúrate que la tabla meseros tenga el campo 'id'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sede_meseros');
    }
};
