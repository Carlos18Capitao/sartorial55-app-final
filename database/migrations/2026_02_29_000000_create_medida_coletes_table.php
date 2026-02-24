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
        Schema::create('medida_coletes', function (Blueprint $table) {
            $table->id();
            $table->string('tamanho')->nullable();
            $table->decimal('ombro_botao', 5, 2)->nullable();
            $table->decimal('comprimento_frente', 5, 2)->nullable();
            $table->decimal('comprimento_costa', 5, 2)->nullable();
            $table->decimal('meia_cinta', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medida_coletes');
    }
};

