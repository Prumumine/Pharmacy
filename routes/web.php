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


Route::get('/', [AuthController::class, 'login'])->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('auth.register.post');

    Route::get('/forgot', function () {
        return view('auth.forgot');
    })->name('auth.forgot');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/suivis', [SuiviController::class, 'index'])->name('suivis.index');

    Route::resource('produits', ProduitsController::class);
    Route::resource('pharmaciens', PharmaciensController::class);
    Route::resource('clients', ClientsController::class);
    Route::resource('ventes', VenteController::class);


    Route::post('/commandes/{id}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
Route::post('/commandes/{id}/refuser', [CommandeController::class, 'refuser'])->name('commandes.refuser');


    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/editer', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});

Route::get('/historique-commandes', [CommandeController::class, 'historique'])
    ->name('commande.historique')
    ->middleware('auth');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
});
