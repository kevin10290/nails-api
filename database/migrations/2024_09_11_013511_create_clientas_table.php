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
        Schema::create('clientas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->date('fecha_nacimiento');
            $table->string('correo', 255)->unique();
            $table->string('contraseña', 255);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientas');
    }
};
