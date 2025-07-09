@extends('layouts.app')

@section('content')
<div class="voyage-container">
    <h1 class="voyage-title">Créer un nouveau voyage</h1>
    <p class="voyage-subtitle">Planifiez votre prochaine aventure en groupe</p>

    @if ($errors->any())
        <div class="voyage-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('voyages.store') }}" method="POST" class="voyage-form">
        @csrf

        <div class="voyage-section">
            <h2 class="voyage-section-title">📋 Informations principales</h2>
            <div class="voyage-row">
                <div>
                    <label for="id_categorie">Catégorie</label>
                    <select name="id_categorie" id="id_categorie" required>
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id_categorie }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nom_voyage">Nom du voyage</label>
                    <input type="text" name="nom_voyage" id="nom_voyage" value="{{ old('nom_voyage') }}" required>
                </div>
            </div>
            <div class="voyage-row">
                <div>
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" id="destination" value="{{ old('destination') }}" required>
                </div>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="voyage-section">
            <h2 class="voyage-section-title">📅 Dates et personnalisation</h2>
            <div class="voyage-row">
                <div>
                    <label for="date_debut">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required>
                </div>
                <div>
                    <label for="date_fin">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required>
                </div>
            </div>
            <div class="voyage-row">
                <div>
                    <label for="nombre_voyageurs">Nombre de voyageurs</label>
                    <input type="number" name="nombre_voyageurs" id="nombre_voyageurs" value="{{ old('nombre_voyageurs', 1) }}" min="1" required>
                </div>
                <div>
                    <label for="visibilite">Visibilité</label>
                    <input type="text" name="visibilite" id="visibilite" value="{{ old('visibilite') }}" required>
                </div>
            </div>
            <div>
                <label for="image_couverture">Image de couverture (URL)</label>
                <input type="url" name="image_couverture" id="image_couverture" value="{{ old('image_couverture') }}" placeholder="https://exemple.com/image.jpg">
                @error('image_couverture')
                    <div class="voyage-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="voyage-footer">
            <button type="submit" class="voyage-btn">Créer</button>
        </div>
    </form>
</div>
@endsection
