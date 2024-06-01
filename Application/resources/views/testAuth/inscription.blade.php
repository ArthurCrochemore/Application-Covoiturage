<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
</head>
<body>
<h2>Créer un utilisateur</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('inscription') }}">
    @csrf

    <div>
        <label for="nid">NID:</label>
        <input type="text" id="nid" name="nid" value="{{ old('NID') }}" required>
    </div>

    <div>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
    </div>

    <div>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
    </div>

    <div>
        <label for="unite">Unité:</label>
        <input type="text" id="unite" name="unite" value="{{ old('unite') }}">
    </div>

    <div>
        <label for="numeroposte">Numéro de poste:</label>
        <input type="text" id="numeroposte" name="numeroposte" value="{{ old('numeroposte') }}">
    </div>

    <div>
        <label for="adressepostale">Adresse postale:</label>
        <input type="text" id="adressepostale" name="adressepostale" value="{{ old('adressepostale') }}">
    </div>

    <div>
        <label for="tel">Téléphone:</label>
        <input type="text" id="tel" name="tel" value="{{ old('tel') }}">
    </div>

    <div>
        <label for="mail">Email:</label>
        <input type="email" id="mail" name="mail" value="{{ old('mail') }}" required>
    </div>

    <div>
        <label for="coordonnees">Coordonnées:</label>
        <input type="text" id="coordonnees" name="coordonnees" value="{{ old('coordonnees') }}">
    </div>

    <div>
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required>
    </div>

    <div>
        <button type="submit">Créer l'utilisateur</button>
    </div>
</form>
</body>
</html>
