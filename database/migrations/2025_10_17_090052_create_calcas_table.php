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
        Schema::create('calcas', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('cos');
            $table->string('vinco');
            $table->string('bainha');
            $table->string('bolsos');
            $table->string('presilhas');
            $table->string('botoes');
            $table->string('status')->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calcas');
    }
};
