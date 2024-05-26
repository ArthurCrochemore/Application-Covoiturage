<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return inertia::render('App_Connexion');
});

Route::get('/app', function () {
    return inertia::render('App');
});

Route::post('/login', [UtilisateurController::class, 'login'])->name('login');

Route::post('/logout', [UtilisateurController::class, 'logout']);

Route::post('/utilisateur', [UtilisateurController::class, 'store']);

Route::get('/accueil', function () {return view('testAuth.accueil');})->name('accueil');

Route::post('/utilisateur', [UtilisateurController::class, 'store'])->name('inscription');

Route::post('/reserver-trajet', [ReservationController::class, 'ReserverTrajet']);
Route::get('/test-timezone', function () {
    return now()->toTimeString();
});

// Routes pour la modification du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/utilisateur/profil', [UtilisateurController::class, 'edit'])->name('utilisateur.edit'); // Page de modification de profil
    Route::post('/utilisateur/update', [UtilisateurController::class, 'update'])->name('utilisateur.update'); // Soumet les modifications de profil
});

