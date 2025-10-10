<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos_personales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_usuario_id')->constrained('perfiles_usuarios')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias_gastos')->onDelete('restrict');
            $table->decimal('monto', 10, 2);
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->string('mes_referencia', 7); // Formato: YYYY-MM
            $table->timestamps();
            
            $table->index(['perfil_usuario_id', 'mes_referencia']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos_personales');
    }
};