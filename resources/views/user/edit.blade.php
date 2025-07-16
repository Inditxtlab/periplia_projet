@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le profil</h2>

   <form action="{{ route('user.update') }}" method="POST">
    @csrf
    @method('PUT')

      <div class="profile-header">
        <img src="{{ $user->photo_profil ?? asset('assets/default-avatar.png') }}" alt="Avatar" class="profile-avatar">
    </div>
        <label for="name">Nom</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="date">Date de Naissance</label>
        <input type="date" name="date" value="{{ old('date_naissance', $user->date_naissance) }}" required>
        <label for="description">Description</label>
        <input type="text" name="description" value="{{ old('description', $user->description) }}"

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection
