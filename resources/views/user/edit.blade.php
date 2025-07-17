@extends('layouts.app')

@section('content')
<div class="container profile-edit">
    <h2 class="profile-edit__title">Modifier le profil</h2>

    <form action="{{ route('user.update') }}" method="POST" class="profile-edit__form">
        @csrf
        @method('PUT')

        <div class="profile-edit__header">
            <p class="profile-edit__label">Photo de Profil</p>
            <img src="{{ $user->photo_profil ?? asset('assets/default-avatar.png') }}"
                 alt="Avatar"
                 id="avatar-preview"
                 class="profile-edit__avatar">

            <input type="text" name="photo_profil" id="photo_profil_input"
                   class="profile-edit__input"
                   placeholder="Collez une URL d’image ici">
        </div>

        <label for="prenom" class="profile-edit__label">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}"
               required class="profile-edit__input">

        <label for="nom" class="profile-edit__label">Nom</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom) }}"
               required class="profile-edit__input">

        <label for="email" class="profile-edit__label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
               required class="profile-edit__input">

        <label for="date_naissance" class="profile-edit__label">Date de naissance</label>
        <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}"
               required class="profile-edit__input">

        <label for="description" class="profile-edit__label">Description</label>
        <textarea id="description" name="description" rows="3"
                  class="profile-edit__textarea">{{ old('description_profil', $user->description_profil) }}</textarea>

        <button type="submit" class="profile-edit__submit-btn">Enregistrer</button>
    </form>
</div>

<script>
    document.getElementById('avatar-preview').addEventListener('click', function () {
        let input = document.getElementById('photo_profil_input');
        input.style.display = input.style.display === 'block' ? 'none' : 'block';
        if (input.style.display === 'block') {
            input.focus();
        }
    });

    document.getElementById('photo_profil_input').addEventListener('input', function () {
        const url = this.value;
        if (url) {
            document.getElementById('avatar-preview').src = url;
        }
    });
</script>
@endsection
