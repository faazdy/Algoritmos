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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario'); // ID del usuario
            $table->string('email', 50);
            $table->string('pass', 50);
            $table->string('rol'); // Esto puede ser eliminado si solo necesitas el roleId
            $table->foreignId('roleId')->constrained('roles', 'idRole'); // Asegúrate de que el nombre de la columna sea correcto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
