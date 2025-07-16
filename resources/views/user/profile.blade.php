@extends('layouts.app')

@section('content')
<style>
    .profile-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin: 30px auto -10px;
        max-width: 600px;
    }

    .profile-btn {
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-edit, .btn-password {
             background: #fff;
                    color: #ff8559;
                    border: 1.5px solid #ff8559;
                    border-radius: 14px;
                    padding: 10px 22px;
                    font-weight: 600;
                    font-size: 1rem;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    transition: background 0.2s, color 0.2s;
                    box-shadow: 0 2px 8px rgba(255, 133, 93, 0.08);
                    margin-right: 30px;
    }

    .btn-edit:hover, .btn-password {
        background: #ffe5d6;
                    color: #ff6a2b;
    }

    .profile-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', sans-serif;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .profile-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .profile-info p {
        margin: 10px 0;
        font-size: 16px;
        color: #555;
    }

    .profile-info strong {
        color: #000;
    }

    .profile-description {
        margin-top: 20px;
        font-style: italic;
        color: #666;
    }

    .delete-section {
        display: flex;
        justify-content: flex-end;
        max-width: 600px;
        margin: 20px auto;
    }

    .btn-delete {
        background-color: #f44336;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-delete:hover {
        background-color: #c62828;
    }
</style>

{{-- Boutons en haut à droite --}}
<div class="profile-actions">
    <a href="{{ route('user.edit') }}">
        <button class="btn-edit">Modifier le profil</button>
    </a>

    <a href="{{ route('user.password.edit') }}">
        <button class="btn-edit">Modifier le mot de passe</button>
    </a>
</div>

{{-- Contenu principal du profil --}}
<div class="profile-container">
    <div class="profile-header">
        <img src="{{ $user->photo_profil ?? asset('assets/default-avatar.png') }}" alt="Avatar" class="profile-avatar">
        <div class="profile-title">Bonjour, {{ $user->prenom }} 👋</div>
    </div>

    <div class="profile-info">
        <p><strong>Nom :</strong> {{ $user->nom }}</p>
        <p><strong>Prénom :</strong> {{ $user->prenom }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') }}</p>
        @if($user->description_profil)
            <p class="profile-description">"{{ $user->description_profil }}"</p>
        @endif
    </div>
</div>

{{-- Bouton de suppression en bas à droite --}}
<div class="delete-section">
    <form action={{-- "{{ route('user.delete') }}"--}} method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Supprimer mon compte</button>
    </form>
</div>


@endsection
