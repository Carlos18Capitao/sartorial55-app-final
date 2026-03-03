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
        Schema::create('medida_calcas', function (Blueprint $table) {
            $table->id();
            $table->string('tamanho')->nullable();
            $table->decimal('cintura', 5, 2)->nullable();
            $table->decimal('anca', 5, 2)->nullable();
            $table->decimal('coxa', 5, 2)->nullable();
            $table->decimal('joelho', 5, 2)->nullable();
            $table->decimal('comprimento', 5, 2)->nullable();
            $table->decimal('bainha', 5, 2)->nullable();
            $table->decimal('gancho_frente', 5, 2)->nullable();
            $table->decimal('gancho_atras', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medida_calcas');
    }
};

