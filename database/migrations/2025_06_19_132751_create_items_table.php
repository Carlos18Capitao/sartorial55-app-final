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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Pendente');
            $table->string('itemable_type', 50)->nullable(); // Type of the polymorphic relation
            $table->string('itemable_id', 50)->nullable(); // ID of the polymorphic relation
            $table->foreignId('encomenda_id')->constrained('encomendas')->onDelete('cascade');
            $table->string('descricao', 255)->nullable();
            $table->decimal('quantidade', 8, 2)->default(1.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
