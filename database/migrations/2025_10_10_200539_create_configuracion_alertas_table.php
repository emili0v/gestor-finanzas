<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion_alertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_usuario_id')->unique()->constrained('perfiles_usuarios')->onDelete('cascade');
            $table->integer('umbral_informacion')->default(50);
            $table->integer('umbral_advertencia')->default(70);
            $table->integer('umbral_critico')->default(90);
            $table->boolean('notificar_en_sistema')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_alertas');
    }
};