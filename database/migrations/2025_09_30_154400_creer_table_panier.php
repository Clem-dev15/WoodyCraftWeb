<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreerTablePanier extends Migration
{
    public function up()
    {
        Schema::create('panier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puzzle_id');
            $table->string('nom'); // nom du puzzle copié
            $table->decimal('prix', 8, 2); // prix du puzzle copié
            $table->timestamps();

            $table->foreign('puzzle_id')->references('id')->on('puzzles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('panier');
    }
}
