<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('puzzles', function (Blueprint $table) {
            // Renommer 'categorie' -> 'categorie_id' si besoin
            if (Schema::hasColumn('puzzles', 'categorie') && !Schema::hasColumn('puzzles', 'categorie_id')) {
                $table->renameColumn('categorie', 'categorie_id');
            }

            // Ajoute la FK si absente
            if (!Schema::hasColumn('puzzles', 'categorie_id')) {
                $table->foreignId('categorie_id')->after('nom')->constrained('categories')->cascadeOnDelete();
            } else {
                // S'assure de la contrainte (drop possible ancien index)
                try { $table->dropForeign(['categorie_id']); } catch (\Throwable $e) {}
                $table->foreign('categorie_id')->references('id')->on('categories')->cascadeOnDelete();
            }
        });

        // Convertir 'prix' en decimal(8,2)
        // Attention: si 'prix' était string, on tente un cast via ALTER
        $driver = DB::getDriverName();
        Schema::table('puzzles', function (Blueprint $table) use ($driver) {
            if (Schema::hasColumn('puzzles', 'prix')) {
                $table->decimal('prix', 8, 2)->change();
            } else {
                $table->decimal('prix', 8, 2)->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('puzzles', function (Blueprint $table) {
            try { $table->dropForeign(['categorie_id']); } catch (\Throwable $e) {}
            // Revenir en arrière si vraiment nécessaire
            // $table->renameColumn('categorie_id', 'categorie');
            // $table->string('prix')->change();
        });
    }
};
