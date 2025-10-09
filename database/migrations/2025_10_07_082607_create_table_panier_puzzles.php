<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('panier_puzzles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paniers_id')->constrained('paniers')->onDelete('cascade');
            $table->foreignId('puzzles_id')->constrained('puzzles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('panier_puzzles');
    }
};
