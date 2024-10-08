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
        Schema::create('mesa_sede', function (Blueprint $table) {
            $table->id('idMesaSede');
            $table->foreignId('mesa')->constrained('mesas', 'idMesa');
            $table->foreignId('sede')->constrained('sedes', 'idSede');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesa_sede');
    }
};
