<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('casaco_id')->constrained('casacos')->onDelete('cascade');
            $table->foreignId('colete_id')->constrained('coletes')->onDelete('cascade')->nullable();
            $table->foreignId('calca_id')->constrained('calcas')->onDelete('cascade')->nullable();
            $table->string('acabamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatos');
    }
};
