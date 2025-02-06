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
        Schema::create('sepomex', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idEstado')->nullable();
            $table->string('estado')->nullable();
            $table->bigInteger('idMunicipio')->nullable();
            $table->string('municipio')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('zona')->nullable();
            $table->string('cp')->nullable();
            $table->string('asentamiento')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepomex');
    }
};
