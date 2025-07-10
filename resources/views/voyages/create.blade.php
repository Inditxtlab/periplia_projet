@extends('layouts.app')

@section('content')
    <div class="voyage-container">
        <h1 class="voyage-title">Créer un nouveau voyage</h1>
        <p class="voyage-subtitle">Planifiez votre prochaine aventure en groupe</p>

        <form action="{{ route('voyages.store') }}" method="POST" class="voyage-form">
            @csrf

            <div class="voyage-section">
                <h2 class="voyage-section-title">📋 Informations principales</h2>

                <!-- Nom du voyage seul sur une ligne -->
                <div class="voyage-field">
                    <label for="nom_voyage">Nom du voyage</label>
                    <input type="text" name="nom_voyage" id="nom_voyage" value="{{ old('nom_voyage') }}" required>
                    @error('nom_voyage')
                        <div class="voyage-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Destination et Catégorie côte à côte -->
                <div class="voyage-row">
                    <div>
                        <label for="destination">Destination</label>
                        <input type="text" name="destination" id="destination" value="{{ old('destination') }}" required>
                        @error('destination')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="id_categorie">Catégorie</label>
                        <select name="id_categorie" id="id_categorie" required>
                            <option value="">-- Choisir une catégorie --</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id_categorie }}" {{ old('id_categorie') == $categorie->id_categorie ? 'selected' : '' }}>{{ $categorie->titre }}</option>
                            @endforeach
                        </select>
                        @error('id_categorie')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="voyage-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="voyage-section">
                <h2 class="voyage-section-title">📅 Dates et personnalisation</h2>
                <div class="voyage-row">
                    <div>
                        <label for="date_debut">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required>
                        @error('date_debut')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="date_fin">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required>
                        @error('date_fin')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="voyage-row">
                    <div>
                        <label for="nombre_voyageurs">Nombre de voyageurs</label>
                        <input type="number" name="nombre_voyageurs" id="nombre_voyageurs"
                            value="{{ old('nombre_voyageurs', 1) }}" min="1" required>
                        @error('nombre_voyageurs')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="visibilite">Visibilité</label>
                        <select name="visibilite" id="visibilite" required>
                            <option value="1" {{ old('visibilite', '1') == '1' ? 'selected' : '' }}>Public</option>
                            <option value="0" {{ old('visibilite') == '0' ? 'selected' : '' }}>Privé</option>
                        </select>
                        @error('visibilite')
                            <div class="voyage-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <input type="hidden" name="status" value="a_venir">
                </div>
                <div>
                    <label for="image_couverture">Image de couverture (URL)</label>
                    <input type="url" name="image_couverture" id="image_couverture" value="{{ old('image_couverture') }}"
                        placeholder="https://exemple.com/image.jpg">
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