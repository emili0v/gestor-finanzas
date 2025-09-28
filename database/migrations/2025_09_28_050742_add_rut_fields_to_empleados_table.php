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
        Schema::table('empleados', function (Blueprint $table) {
            // Agregar los campos que faltan
            $table->string('rut')->after('nombre');
            $table->string('dig_verificador', 1)->after('rut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            // Eliminar los campos si se hace rollback
            $table->dropColumn(['rut', 'dig_verificador']);
        });
    }
};