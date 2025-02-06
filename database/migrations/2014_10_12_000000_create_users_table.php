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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('intraprom_id');
            $table->bigInteger('rol_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('usuario')->nullable();
            $table->string('password')->nullable();
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
