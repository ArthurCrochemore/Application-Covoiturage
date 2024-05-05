<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('mail', 'mdp');
        $utilisateur = Utilisateur::where('mail', $credentials['mail'])->first();

        if ($utilisateur && Hash::check($credentials['mdp'], $utilisateur->mdp)) {
            Auth::login($utilisateur);

            return redirect()->intended('/accueil'); // à définir pour l'url
        }

        return redirect('/login')->withInput($request->only('mail'))->withErrors([
            'mdp' => 'Email ou mot de passe incorrect.',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nid' => 'required|string|max:10',
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'unite' => 'nullable|string|max:50',
            'numeroposte' => 'nullable|string|max:10',
            'adressepostale' => 'nullable|string|max:100',
            'tel' => 'nullable|string|max:50',
            'mail' => 'required|email|unique:utilisateur|max:50',
            'coordonnees' => 'nullable|string|max:50',
            'mdp' => 'required|string|min:6|max:50',
        ]);

        $validatedData['mdp'] = Hash::make($validatedData['mdp']);

        $utilisateur = Utilisateur::create($validatedData);

        // Redirection à définir
        return redirect('/login')->with('success', 'Utilisateur créé avec succès!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Redirection à définir
        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
