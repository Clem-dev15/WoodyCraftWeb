<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuzzleController;
use App\HTTP\Controllers\CategorieController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('puzzles', PuzzleController::class)->middleware('auth');
Route::resource('categories', CategorieController::class)->middleware('auth');

Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('nom', [CategorieController::class, 'show'])->name('categories.show');

// Panier
Route::post('/panier/ajouter', [App\Http\Controllers\PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::get('/panier', [App\Http\Controllers\PanierController::class, 'index'])->name('panier.index');
Route::delete('/panier/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::patch('/panier/{id}/quantite', [PanierController::class, 'retirerQuantite'])->name('panier.supprimer_quantite');

//Panier
Route::get('/commande', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commande', [CommandeController::class, 'store'])->name('commandes.store');


require __DIR__.'/auth.php';