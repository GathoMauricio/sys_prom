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
        Schema::create('sys_prom_movimientos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('autor_id');
            $table->biginteger('proceso_id');
            $table->biginteger('empleado_id');
            $table->integer('consecutivo');
            $table->string('tipo');
            $table->string('estatus')->default('Por procesar');
            $table->dateTime('deleted_at', 7)->nullable()->index();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_prom_movimientos');
    }
};
