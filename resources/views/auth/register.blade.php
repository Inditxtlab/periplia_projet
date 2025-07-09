@extends('layouts.app')

@section('content')
<div class="register-container">
    <form method="POST" action="{{ route('register') }}" class="register-box">
        @csrf

        <h2 class="register-title">Enregistrez-vous</h2>

        <div class="register-avatar">
            <!-- Icône utilisateur en SVG -->
            <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="45" cy="45" r="45" fill="#EDEDED"/>
                <circle cx="45" cy="40" r="18" fill="#BDBDBD"/>
                <ellipse cx="45" cy="68" rx="24" ry="14" fill="#BDBDBD"/>
            </svg>
        </div>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

        <div class="register-row">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
            </div>
        </div>

        <label for="email">E-mail :</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirmation de mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit" class="register-btn">Créer mon compte</button>
    </form>
</div>
@endsection
