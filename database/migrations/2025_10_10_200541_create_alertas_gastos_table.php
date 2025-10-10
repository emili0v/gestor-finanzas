<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertas_gastos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_usuario_id')->constrained('perfiles_usuarios')->onDelete('cascade');
            $table->string('periodo', 7); // Formato: YYYY-MM
            $table->enum('umbral_alcanzado', ['50', '70', '90']);
            $table->enum('nivel', ['informacion', 'advertencia', 'critico']);
            $table->decimal('porcentaje_actual', 5, 2);
            $table->decimal('saldo_restante', 10, 2);
            $table->text('mensaje');
            $table->boolean('leida')->default(false);
            $table->timestamp('fecha_generacion')->useCurrent();
            $table->timestamp('fecha_lectura')->nullable();
            
            $table->index(['perfil_usuario_id', 'leida']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas_gastos');
    }
};