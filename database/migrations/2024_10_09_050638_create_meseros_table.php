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
        Schema::create('meseros', function (Blueprint $table) {
            $table->id('idMesero');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono', 20);
            $table->string('email', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meseros');
    }
};
