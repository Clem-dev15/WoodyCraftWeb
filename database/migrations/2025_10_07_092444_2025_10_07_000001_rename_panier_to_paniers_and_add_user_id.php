<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Renomme "panier" (singulier) -> "paniers" si besoin
        if (Schema::hasTable('panier') && !Schema::hasTable('paniers')) {
            Schema::rename('panier', 'paniers');
        }

        // Ajoute user_id si absent
        if (Schema::hasTable('paniers')) {
            Schema::table('paniers', function (Blueprint $table) {
                if (!Schema::hasColumn('paniers', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->after('id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('paniers')) {
            Schema::table('paniers', function (Blueprint $table) {
                if (Schema::hasColumn('paniers', 'user_id')) {
                    $table->dropConstrainedForeignId('user_id');
                }
            });
        }

        if (Schema::hasTable('paniers') && !Schema::hasTable('panier')) {
            Schema::rename('paniers', 'panier');
        }
    }
};
