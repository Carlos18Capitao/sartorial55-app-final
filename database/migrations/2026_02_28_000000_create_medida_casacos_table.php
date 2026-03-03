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
        Schema::create('medida_casacos', function (Blueprint $table) {
            $table->id();
            $table->decimal('base', 5, 2)->nullable();
            $table->decimal('distancia_ombro_botao', 5, 2)->nullable();
            $table->decimal('comprimento_manga', 5, 2)->nullable();
            $table->decimal('bicep', 5, 2)->nullable();
            $table->decimal('boca_manga', 5, 2)->nullable();
            $table->decimal('meia_cinta', 5, 2)->nullable();
            $table->decimal('meio_ombro', 5, 2)->nullable();
            $table->decimal('meia_costa', 5, 2)->nullable();
            $table->decimal('comprimento_costa', 5, 2)->nullable();
            $table->decimal('comprimento_frente', 5, 2)->nullable();
            $table->decimal('racha_lateral', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medida_casacos');
    }
};

