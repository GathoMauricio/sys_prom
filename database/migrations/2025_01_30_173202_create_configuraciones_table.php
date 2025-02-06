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
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->double('salario_minimo_resto_pais', 6, 2);
            $table->double('salario_minimo_frontera', 6, 2);
            $table->double('reembolso_gasolina', 6, 2);
            $table->string('doc_solicitud_empleo', 10);
            $table->string('doc_fotografia', 10);
            $table->string('doc_ine', 10);
            $table->string('doc_acta_nacimiento', 10);
            $table->string('doc_nss', 10);
            $table->string('doc_comprobante_domicilio', 10);
            $table->string('doc_comprobante_estudios', 10);
            $table->string('doc_curp', 10);
            $table->string('doc_csf', 10);
            $table->string('doc_soporte_bancario', 10);
            $table->string('doc_contrato', 10);
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
