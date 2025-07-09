@extends('layouts.app')

@section('title', 'Dashboard utilisateur')

@section('content')
    <h1>Bienvenue {{ auth()->user()->name }}</h1>

 <h1>Bienvenue sur le dashboard utilisateur</h1>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Déconnexion</button>
</form>
@endsection
