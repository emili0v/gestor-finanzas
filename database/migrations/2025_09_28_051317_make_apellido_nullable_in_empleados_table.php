<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('apellido')->nullable()->change();
            $table->string('departamento')->nullable()->change();
            $table->string('cargo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('apellido')->nullable(false)->change();
            $table->string('departamento')->nullable(false)->change();
            $table->string('cargo')->nullable(false)->change();
        });
    }
};