<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('adresse_livraisons')) {
            Schema::create('adresse_livraisons', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('ville');
                $table->string('departement', 5);
                $table->string('nom_rue');
                $table->string('numero_rue', 10);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('adresse_livraisons');
    }
};