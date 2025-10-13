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
        Schema::create('casacos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo', 100);
            $table->string('lapela', 50)->nullable();
            $table->string('bolsos', 10)->nullable();
            $table->string('forro', 100)->nullable();
            $table->string('botao', 10)->nullable();
            $table->string('manga', 10)->default('F25');
            $table->string('costas', 100)->default('2F com pesos');
            $table->string('acabamento')->nullable();
            $table->string('status')->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casacos');
    }
};
