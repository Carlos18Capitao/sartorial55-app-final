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
        Schema::create('cliente_medidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');

            // Medidas da Camisa (12 campos)
            $table->decimal('colarinho', 5, 2)->nullable();
            $table->decimal('ombro_ombro', 5, 2)->nullable();
            $table->decimal('peito', 5, 2)->nullable();
            $table->decimal('cintura', 5, 2)->nullable();
            $table->decimal('anca', 5, 2)->nullable();
            $table->decimal('bicep', 5, 2)->nullable();
            $table->decimal('comprimento_manga_direita', 5, 2)->nullable();
            $table->decimal('comprimento_manga_esquerda', 5, 2)->nullable();
            $table->decimal('comprimento_manga_curta', 5, 2)->nullable();
            $table->decimal('punho_esquerdo', 5, 2)->nullable();
            $table->decimal('punho_direito', 5, 2)->nullable();
            $table->decimal('comprimento_camisa', 5, 2)->nullable();

            // Medidas do Casaco (11 campos)
            $table->decimal('base', 5, 2)->nullable();
            $table->decimal('distancia_ombro_botao', 5, 2)->nullable();
            $table->decimal('comprimento_manga_casaco', 5, 2)->nullable();
            $table->decimal('bicep_casaco', 5, 2)->nullable();
            $table->decimal('boca_manga', 5, 2)->nullable();
            $table->decimal('meia_cinta', 5, 2)->nullable();
            $table->decimal('meio_ombro', 5, 2)->nullable();
            $table->decimal('meia_costa', 5, 2)->nullable();
            $table->decimal('comprimento_costa', 5, 2)->nullable();
            $table->decimal('comprimento_frente', 5, 2)->nullable();
            $table->decimal('racha_lateral_casaco', 5, 2)->nullable();

            // Medidas do Colete (5 campos)
            $table->string('tamanho_colete')->nullable();
            $table->decimal('ombro_botao_colete', 5, 2)->nullable();
            $table->decimal('comprimento_frente_colete', 5, 2)->nullable();
            $table->decimal('comprimento_costa_colete', 5, 2)->nullable();
            $table->decimal('meia_cinta_colete', 5, 2)->nullable();

            // Medidas da Calça (9 campos)
            $table->string('tamanho_calca')->nullable();
            $table->decimal('cintura_calca', 5, 2)->nullable();
            $table->decimal('anca_calca', 5, 2)->nullable();
            $table->decimal('coxa', 5, 2)->nullable();
            $table->decimal('joelho', 5, 2)->nullable();
            $table->decimal('comprimento_calca', 5, 2)->nullable();
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
        Schema::dropIfExists('cliente_medidas');
    }
};

