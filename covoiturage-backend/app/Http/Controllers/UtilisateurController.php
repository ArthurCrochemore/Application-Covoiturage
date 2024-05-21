<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('Mail', 'Mot_De_Passe');
    //     $utilisateur = Utilisateur::where('Mail', $credentials['Mail'])->first();

    //     if ($utilisateur && Hash::check($credentials['Mot_De_Passe'], $utilisateur->Mot_De_Passe)) {
    //         Auth::login($utilisateur);

    //         return redirect()->intended('/accueil'); // à définir pour l'url
    //     }

    //     return redirect('/login')->withInput($request->only('Mail'))->withErrors([
    //         'Mot_De_Passe' => 'Email ou mot de passe incorrect.',
    //     ]);
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'NID' => 'required|string|max:10',
    //         'Nom' => 'required|string|max:50',
    //         'Prenom' => 'required|string|max:50',
    //         'Unite' => 'nullable|string|max:50',
    //         'Numero_De_Poste' => 'nullable|string|max:10',
    //         'Numero_De_Tel' => 'nullable|string|max:50',
    //         'Mail' => 'required|email|unique:utilisateur|max:50',
    //         'Mot_De_Passe' => 'required|string|min:6|max:50',
    //     ]);

        $validatedData['Mot_De_Passe'] = Hash::make($validatedData['Mot_De_Passe']);

        $Utilisateur = Utilisateur::create($validatedData);

    //     // Redirection à définir
    //     return redirect('/login')->with('success', 'Utilisateur créé avec succès!');
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     // Redirection à définir
    //     return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    // }
}
