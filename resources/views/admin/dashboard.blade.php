@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Bienvenue, {{ Auth::guard('admin')->user()->email }}</h1>

 <h1>Bienvenue sur le dashboard admin</h1>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Déconnexion</button>
</form>
@endsection
