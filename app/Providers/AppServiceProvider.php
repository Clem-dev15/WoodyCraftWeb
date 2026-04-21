<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Panier;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $panierCount = 0;

            if (auth()->check()) {
                $panierCount = Panier::where('user_id', auth()->id())->sum('quantite');
            }

            $view->with('panierCount', $panierCount);
        });
    }
}