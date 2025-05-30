<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\PharmaciensController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\VenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'ouverture = formulaire de login
Route::get('/', [AuthController::class, 'login'])->name('login');

// Routes pour les invités
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('auth.register.post');

    Route::get('/forgot', function () {
        return view('auth.forgot');
    })->name('auth.forgot');
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Page d'accueil après connexion
    Route::get('/suivis', function () {
        return view('suivis.index');
    })->name('suivis');

    // Modules accessibles à tout utilisateur connecté
    Route::resource('produits', ProduitsController::class);
    Route::resource('pharmaciens', PharmaciensController::class);
    Route::resource('clients', ClientsController::class);
    Route::resource('ventes', VenteController::class);
    Route::get('/suivis', [SuiviController::class, 'index'])->name('suivis.index');
});
