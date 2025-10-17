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
        Schema::create('camisas', function (Blueprint $table) {
            $table->id();
            $table->string('colarinho');
            $table->string('punho');
            $table->string('pincas');
            $table->string('carcela');
            $table->string('acabamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camisas');
    }
};
