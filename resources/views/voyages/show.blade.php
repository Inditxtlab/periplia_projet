@extends('layouts.app')

@section('title', 'Dashboard utilisateur')

@section('content')
    <h1>Bienvenue {{ auth()->user()->prenom }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>

    <h2>Mes voyages</h2>

    <!-- Filtres -->
    <form method="GET" action="{{ route('dashboard') }}" class="filters">
        <select name="categorie">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id_categorie }}" {{ request('categorie') == $cat->id_categorie ? 'selected' : '' }}>
                    {{ $cat->nom_categorie }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Tous les statuts</option>
            <option value="a_venir" {{ request('status') == 'a_venir' ? 'selected' : '' }}>À venir</option>
            <option value="en_route" {{ request('status') == 'en_route' ? 'selected' : '' }}>En route</option>
            <option value="termine" {{ request('status') == 'termine' ? 'selected' : '' }}>Terminé</option>
        </select>

        <button type="submit">Filtrer</button>
    </form>

    <!-- Liste des voyages -->
    <div class="voyages-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse($voyages as $voyage)
            <div class="voyage-card" style="width: 250px; border: 1px solid #ccc; padding: 10px; border-radius: 8px;">
                <img src="{{ $voyage->image_couverture ?? asset('assets/img_default.jpg') }}" alt="image par default"{{ $voyage->nom_voyage }}" style="width:100%; height:150px; object-fit:cover;">
                <h3>{{ $voyage->nom_voyage }}</h3>
                <p><strong>Catégorie :</strong> {{ $voyage->categorie->nom_categorie ?? 'N/A' }}</p>
                <p><strong>Status :</strong> {{ ucfirst(str_replace('_', ' ', $voyage->status)) }}</p>
                <a href="{{ route('voyages.show', $voyage->id_voyage) }}">Voir le voyage</a>
            </div>
        @empty
            <p>Vous n’avez encore créé aucun voyage.</p>
        @endforelse
    </div>
@endsection
