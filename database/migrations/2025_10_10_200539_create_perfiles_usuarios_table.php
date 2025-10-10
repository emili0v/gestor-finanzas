<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->unique()->constrained('empleados')->onDelete('cascade');
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('contacto_emergencia_nombre', 255)->nullable();
            $table->string('contacto_emergencia_telefono', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles_usuarios');
    }
};