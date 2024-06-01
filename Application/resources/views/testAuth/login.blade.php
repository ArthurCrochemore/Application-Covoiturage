<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
</head>
<body>
<h2>Connexion</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="mail">Email:</label>
        <input type="email" id="mail" name="mail" value="{{ old('mail') }}" required autofocus>
    </div>

    <div>
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required>
    </div>

    <div>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Se souvenir de moi</label>
    </div>

    <div>
        <button type="submit">Se connecter</button>
    </div>
</form>
</body>
</html>
