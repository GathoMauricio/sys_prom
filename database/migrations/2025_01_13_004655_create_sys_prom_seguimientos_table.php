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
        Schema::create('sys_prom_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('autor_id')->description('Hace referencia al autor del seguimiento');
            $table->bigInteger('proceso_id')->description('Hace referencia al proceso de contratación');
            $table->text('contenido')->description('Texto que contiene el cuerpo del seguimiento');
            $table->dateTime('deleted_at', 7)->nullable()->index();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_prom_seguimientos');
    }
};
