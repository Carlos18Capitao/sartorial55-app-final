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
        Schema::table('item_encomendas', function (Blueprint $table) {
            $table->foreignId('cliente_medidas_id')->nullable()->constrained('cliente_medidas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_encomendas', function (Blueprint $table) {
            $table->dropForeign(['cliente_medidas_id']);
            $table->dropColumn('cliente_medidas_id');
        });
    }
};
