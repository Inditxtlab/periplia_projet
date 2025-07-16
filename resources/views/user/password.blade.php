@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Changer le mot de passe</h2>

    <form action="{{ route('user.password.update') }}" method="POST">
    @csrf
    @method('PUT')

        <label for="current_password">Mot de passe actuel</label>
        <input type="password" name="current_password" required>

        <label for="password">Nouveau mot de passe</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Mettre à jour</button>
    </form>
</div>
@endsection
