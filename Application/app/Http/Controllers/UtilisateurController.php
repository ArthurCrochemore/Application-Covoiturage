<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UtilisateurController extends Controller
{
    /**
     * Méthode pour afficher le formulaire de connexion
     */
    public function login(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $credentials = $request->only('Mail', 'Mot_De_Passe');
        $utilisateur = Utilisateur::where('Mail', $credentials['Mail'])->first();

        if ($utilisateur && Hash::check($credentials['Mot_De_Passe'], $utilisateur->Mot_De_Passe)) {
            Auth::login($utilisateur);

            return redirect()->intended('/accueil'); //à définir pour l'url
        }
        return response()->json(['errors' => ['Mot_De_Passe' => 'Email ou mot de passe incorrect.']], 422);
    }


    /**
     * Méthode pour enregistrer un nouvel utilisateur
     */
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        // TODO : doit prendre en compte l'adresse saisie
        // TODO : selon cahier des charges, l'inscription crée une demande, puis c'est l'admin qui gère le "store" à partir de la demande


        $validatedData = $request->validate([
            'NID' => 'required|integer',
            'Nom' => 'required|string|max:50',
            'Prenom' => 'required|string|max:50',
            'Unite' => 'nullable|string|max:50',
            'Numero_De_Poste' => 'nullable|string|max:10',
            'Numero_De_Telephone' => 'nullable|string|max:50',
            'Mail' => 'required|email|unique:Utilisateur|max:50',
            'Mot_De_Passe' => 'required|string|min:6|max:50',
        ]);

        $validatedData['Mot_De_Passe'] = Hash::make($validatedData['Mot_De_Passe']);

        try {
            $utilisateur = Utilisateur::create($validatedData);
            return redirect('/accueil')->with('success', 'Utilisateur créé avec succès!');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Méthode pour déconnecter l'utilisateur
     */
    public function logout(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        Auth::logout();

        //Redirection à définir
        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * Méthode pour mettre à jour le profil de l'utilisateur
     */
    public function update(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $utilisateur = Auth::user();

        // TODO : accepter meme email
        $validatedData = $request->validate([
            'Mail' => 'required|email|unique:Utilisateur|max:50',
            'Unite' => 'nullable|string|max:50',
            'Numero_De_Poste' => 'nullable|string|max:10',
            'Prenom' => 'required|string|max:50',
            'Nom' => 'required|string|max:50',
            'Numero_De_Tel' => 'nullable|string|max:50',
            // TODO : Gerer l'adresse
        ]);

        $utilisateur->update($validatedData);

        // Redirection après mise à jour
        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    // Méthode pour afficher le formulaire de modification du profil
    public function edit(Request $request): \Illuminate\Contracts\View\View
    {
        $utilisateur = Auth::user();

        return view('utilisateur.edit', compact('utilisateur'));
    }

    /**
     * Méthode qui affiche le profil de l'utilisateur connecté
     */
    public function getProfil(Request $request)
    {
        $utilisateur = Auth::user();

        return response()->json(['' => $utilisateur]);
    }

    /**
     * Méthode pour vérifier si un email existe déjà
     */
    public function verifierEmail($email)
{
    $utilisateur = Utilisateur::where('Mail', $email)->exists();
    
    return $utilisateur ? 'true' : 'false';
}





}
