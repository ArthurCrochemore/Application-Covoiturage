<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function login(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $credentials = $request->only('Mail', 'Mot_De_Passe');
        $utilisateur = Utilisateur::where('Mail', $credentials['Mail'])->first();

        if ($utilisateur && Hash::check($credentials['Mot_De_Passe'], $utilisateur->Mot_De_Passe)) {
            Auth::login($utilisateur);

            return redirect()->intended('/accueil'); //à définir pour l'url
        }

        return redirect('/login')->withInput($request->only('Mail'))->withErrors([
            'Mot_De_Passe' => 'Email ou mot de passe incorrect.',
        ]);
    }

    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
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
            return redirect('/login')->with('success', 'Utilisateur créé avec succès!');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        Auth::logout();

        //Redirection à définir
        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function update(Request $request, Utilisateur $utilisateur): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $validatedData = $request->validate([
            'NID' => 'required|string|max:10',
            'Nom' => 'required|string|max:50',
            'Prenom' => 'required|string|max:50',
            'Unite' => 'nullable|string|max:50',
            'Numero_De_Poste' => 'nullable|string|max:10',
            'Numero_De_Tel' => 'nullable|string|max:50',
            'Mail' => 'required|email|max:50|unique:utilisateur,Mail,' . $utilisateur->Id_Utilisateur,
            'Mot_De_Passe' => 'nullable|string|min:6|max:50',
        ]);

        if ($request->filled('Mot_De_Passe')) {
            $validatedData['Mot_De_Passe'] = Hash::make($validatedData['Mot_De_Passe']);
        } else {
            unset($validatedData['Mot_De_Passe']);
        }

        $utilisateur->update($validatedData);

        // Redirection après mise à jour
        return redirect()->back()->with('success', 'Profil mis à jour avec succès!');
    }

    // Méthode pour afficher le formulaire de modification du profil
    public function edit(Request $request): \Illuminate\Contracts\View\View
    {
        $utilisateur = Auth::user();

        return view('utilisateur.edit', compact('utilisateur'));
    }

}
