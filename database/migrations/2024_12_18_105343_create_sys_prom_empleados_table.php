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
        Schema::create('sys_prom_empleados', function (Blueprint $table) {
            $table->id();
            $table->string('origen')->nullable()->description('El empleado puede provenir de sicoss o ser nuevo en sysprom');
            $table->string('tipo')->nullable();
            $table->string('estatus')->nullable();
            $table->bigInteger('sicoss_id')->nullable();
            $table->bigInteger('sepomex_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apaterno')->nullable();
            $table->string('amaterno')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('nss')->nullable();
            $table->string('rfc')->nullable();
            $table->string('estado_nacimiento')->nullable();
            $table->string('cp')->nullable();
            $table->string('estado')->nullable();
            $table->string('delegacion')->nullable();
            $table->string('colonia')->nullable();
            $table->string('calle_numero')->nullable();
            $table->string('banco')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('telefono_casa')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('cc')->nullable();
            $table->bigInteger('pp')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_imss')->nullable();
            $table->text('puesto')->nullable();
            $table->text('id_puesto')->nullable();
            $table->string('tipo_sueldo_diario', 20)->nullable();
            $table->double('sueldo_diario', 6, 2)->default(0)->nullable();
            $table->string('premio_puntualidad', 2)->default('NO')->nullable();
            $table->double('premio_puntualidad_cant', 6, 2)->default(0)->nullable();
            $table->string('premio_asistencia', 2)->default('NO')->nullable();
            $table->double('premio_asistencia_cant', 6, 2)->default(0)->nullable();
            $table->string('despensa', 2)->default('NO')->nullable();
            $table->double('despensa_cant', 6, 2)->default(0)->nullable();
            $table->string('reembolso_gasolina', 2)->default('NO')->nullable();
            $table->double('reembolso_gasolina_cant', 6, 2)->default(0)->nullable();
            $table->string('doc_solicitud_empleo')->nullable();
            $table->string('doc_fotografia')->nullable();
            $table->string('doc_ine')->nullable();
            $table->string('doc_acta_nacimiento')->nullable();
            $table->string('doc_nss')->nullable();
            $table->string('doc_comprobante_domicilio')->nullable();
            $table->string('doc_comprobante_estudios')->nullable();
            $table->string('doc_curp')->nullable();
            $table->string('doc_csf')->nullable();
            $table->string('doc_soporte_bancario')->nullable();
            $table->string('doc_contrato')->nullable();
            $table->dateTime('deleted_at', 7)->nullable()->index();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_prom_empleados');
    }
};
