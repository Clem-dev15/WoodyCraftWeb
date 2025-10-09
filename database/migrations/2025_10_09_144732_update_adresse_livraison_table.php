<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseLivraisonsTable extends Migration
{
    public function up()
    {
        Schema::create('adresse_livraisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ville');
            $table->string('departement', 5);
            $table->string('nom_rue');
            $table->string('numero_rue', 10);
            $table->timestamps();

            // Clé étrangère liée à la table users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adresse_livraisons');
    }
}

