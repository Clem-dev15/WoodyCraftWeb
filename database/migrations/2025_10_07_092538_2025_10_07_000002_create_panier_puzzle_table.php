<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('panier_puzzle')) {
            Schema::create('panier_puzzle', function (Blueprint $table) {
                $table->id();
                $table->foreignId('panier_id')->constrained('paniers')->cascadeOnDelete();
                $table->foreignId('puzzle_id')->constrained('puzzles')->cascadeOnDelete();
                $table->timestamps();
                $table->unique(['panier_id', 'puzzle_id']); // pas de doublons
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('panier_puzzle');
    }
};
