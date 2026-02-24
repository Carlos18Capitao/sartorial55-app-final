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
        Schema::create('medida_camisas', function (Blueprint $table) {
            $table->id();
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
            $table->decimal('comprimento', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medida_camisas');
    }
};

