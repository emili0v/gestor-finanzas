<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metas_ahorro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_usuario_id')->constrained('perfiles_usuarios')->onDelete('cascade');
            $table->string('nombre_meta', 255);
            $table->text('descripcion')->nullable();
            $table->decimal('monto_objetivo', 10, 2);
            $table->decimal('monto_actual', 10, 2)->default(0);
            $table->date('fecha_inicio');
            $table->date('fecha_objetivo')->nullable();
            $table->enum('estado', ['en_progreso', 'completada', 'cancelada', 'pausada'])->default('en_progreso');
            $table->timestamps();
            
            $table->index(['perfil_usuario_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metas_ahorro');
    }
};