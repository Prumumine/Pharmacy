<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\PharmaciensController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'ouverture = formulaire de login
Route::get('/', [AuthController::class, 'login'])->name('login');

// Routes accessibles uniquement aux invités (non authentifiés)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('auth.register.post');

    Route::get('/forgot', function () {
        return view('auth.forgot');
    })->name('auth.forgot');
});

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Page d'accueil après connexion
    Route::get('/suivis', [SuiviController::class, 'index'])->name('suivis.index');

    // Ressources accessibles à tous les utilisateurs connectés
    Route::resource('produits', ProduitsController::class);
    Route::resource('pharmaciens', PharmaciensController::class);
    Route::resource('clients', ClientsController::class);
    Route::resource('ventes', VenteController::class);

    // Profil utilisateur
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/editer', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Commandes accessibles à tous les utilisateurs connectés
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');

    // Liste des utilisateurs - accessible uniquement si contrôlé dans UserController
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});

// Routes spécifiques à l'admin (middleware 'auth' + 'admin')
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestion des utilisateurs par l'admin
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
});
