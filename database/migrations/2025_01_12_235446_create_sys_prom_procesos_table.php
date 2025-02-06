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
        Schema::create('sys_prom_procesos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('autor_id')->description('Hace referencia al usuario que dió de alta al aspirante/empleado');
            $table->bigInteger('empleado_id')->description('Hace referencia foranea al aspirante/empleado al que pertenece el proceso');
            $table->string('tipo')->description('Indica si el empleado es de nuevo ingreso o es una recontratación');
            $table->string('estatus')->description('Indica la etapa en la que se encuentra el proceso inicialmente entra para revisiones y avanza hasta ser concluido o rechazado por un usuario o por el schedule del sistema');
            $table->string('estatus_documentacion')->default('Pendiente')->description('Indica si toda la documentación que concierne al proceso es aprobada');
            $table->string('estatus_doc_solicitud_empleo')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_fotografia')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_ine')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_acta_nacimiento')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_nss')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_comprobante_domicilio')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_comprobante_estudios')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_curp')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_csf')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_soporte_bancario')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->string('estatus_doc_contrato')->default('Pendiente')->description('Indica si el documento en cuestion ha sido aprobado');
            $table->json('json_empleado')->nullable()->description('Guarda el estado actual del modelo para llevar un historico');
            $table->dateTime('deleted_at', 7)->nullable()->index();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_prom_procesos');
    }
};
