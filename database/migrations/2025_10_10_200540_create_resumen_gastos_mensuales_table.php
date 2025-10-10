<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumen_gastos_mensuales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_usuario_id')->constrained('perfiles_usuarios')->onDelete('cascade');
            $table->string('periodo', 7); // Formato: YYYY-MM
            $table->decimal('sueldo_liquido', 10, 2);
            $table->decimal('total_gastado', 10, 2);
            $table->decimal('porcentaje_gastado', 5, 2);
            $table->decimal('saldo_disponible', 10, 2);
            $table->timestamp('actualizado_en')->useCurrent();
            
            $table->unique(['perfil_usuario_id', 'periodo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumen_gastos_mensuales');
    }
};