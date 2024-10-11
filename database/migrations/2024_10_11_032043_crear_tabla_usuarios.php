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
            $table->id('idUsuario');
            $table->string('email', 50)->unique();
            $table->string('pass', 255);
            $table->enum('rol', ['mesero', 'cajero', 'admin']);
            $table->unsignedBigInteger('idMesero')->nullable();
            $table->unsignedBigInteger('idCajero')->nullable();
            $table->unsignedBigInteger('idAdmin')->nullable();

            // Foreign keys
            $table->foreign('idMesero')->references('idMesero')->on('meseros')->onDelete('cascade');
            $table->foreign('idCajero')->references('idCajero')->on('cajeros')->onDelete('cascade');
            $table->foreign('idAdmin')->references('idAdmin')->on('admins')->onDelete('cascade');
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
