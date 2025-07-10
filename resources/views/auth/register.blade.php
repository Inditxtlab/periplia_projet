@extends('layouts.app')

@section('content')
    <div class="register-container">
        <form method="POST" action="{{ route('register') }}" class="register-box">
            @csrf

            <h2 class="register-title">Enregistrez-vous</h2>

            <div class="register-avatar">
                <div id="avatarPreview"
                    style="cursor: pointer; width: 90px; height: 90px; border-radius: 50%; overflow: hidden; background: #EDEDED; display: flex; align-items: center; justify-content: center;">
                    <!-- SVG par défaut -->
                    <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="45" cy="45" r="45" fill="#EDEDED" />
                        <circle cx="45" cy="40" r="18" fill="#BDBDBD" />
                        <ellipse cx="45" cy="68" rx="24" ry="14" fill="#BDBDBD" />
                    </svg>
                </div>
                <input type="hidden" id="photo_profil" name="photo_profil" value="{{ old('photo_profil') }}">
            </div>

            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

            <div class="register-row">
                <div class="register-field">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
                </div>
                <div class="register-field">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                </div>
            </div>

            <div class="register-field">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="register-field">
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
            </div>

            <div class="register-field">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="register-field">
                <label for="password_confirmation">Confirmation de mot de passe :</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="register-btn">Créer mon compte</button>

            <script>
                document.getElementById('avatarPreview').addEventListener('click', function () {
                    const url = prompt("Collez l'URL de votre photo de profil (jpg, png, gif...) :");

                    if (!url) return; // Laisse le SVG si rien n'est entré

                    // Vérifie que l’URL est bien celle d’une image
                    const imagePattern = /\.(jpeg|jpg|png|gif|webp|svg)$/i;

                    if (!imagePattern.test(url)) {
                        alert("URL invalide. Elle doit se terminer par .jpg, .png, .gif, etc.");
                        return;
                    }

                    const img = document.createElement('img');
                    img.src = url;
                    img.alt = 'Photo de profil';
                    img.style.width = '90px';
                    img.style.height = '90px';
                    img.style.borderRadius = '50%';
                    img.style.objectFit = 'cover';

                    img.onload = () => {
                        const preview = document.getElementById('avatarPreview');
                        preview.innerHTML = '';
                        preview.appendChild(img);
                        document.getElementById('photo_profil').value = url;
                    };

                    img.onerror = () => {
                        alert("Impossible de charger l'image. Vérifiez que l'URL est correcte.");
                    };
                });
            </script>
        </form>
    </div>
@endsection