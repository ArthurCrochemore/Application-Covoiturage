<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\TrajetController;
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
    if (auth()->check()) {
        return redirect('/app');
    } else {
        return view('welcomeConnexion');
    }
});

Route::get('/app', function () {
    if (auth()->check()) {
        return view('welcomeApp');
    } else {
        return redirect('/');
    }
});

Route::get('/admin', function () {
    return view('welcomeAdmin');
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

Route::post('/utilisateur/update', [UtilisateurController::class, 'update'])->name('utilisateur.update');

// Routes pour la modification du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/utilisateur/profil', [UtilisateurController::class, 'edit'])->name('utilisateur.edit'); // Page de modification de profil

    Route::get('/trajets-conducteur', [TrajetController::class, 'getAllTrajetsConducteurs']);

    Route::get('/trajets-passager', [TrajetController::class, 'getAllTrajetsPassagers']);
});

Route::get('/profil', [UtilisateurController::class, 'getProfil']);

