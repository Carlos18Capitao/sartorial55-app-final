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
        Schema::create('item_encomendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encomenda_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['camisa', 'fato', 'casaco', 'calca', 'colete']);
            $table->string('foto')->nullable();
            $table->enum('estado', ['pendente', 'em_producao', 'pronto', 'enviado', 'entregue'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->date('data_envio')->nullable();
            $table->date('data_previsao')->nullable();

            // Campos polimórficos para medidas específicas
            $table->unsignedBigInteger('medida_id')->nullable();
            $table->string('medida_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_encomendas');
    }
};

