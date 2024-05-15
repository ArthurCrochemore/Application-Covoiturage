<?php

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
    return inertia::render('Test');
});

Route::post('/login', [UtilisateurController::class, 'login'])->name('login');

Route::post('/utilisateur', [UtilisateurController::class, 'store']);

Route::get('/accueil', function () {return view('testAuth.accueil');})->name('accueil');

Route::post('/utilisateur', [UtilisateurController::class, 'store'])->name('inscription');
