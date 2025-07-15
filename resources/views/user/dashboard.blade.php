@extends('layouts.app')

@section('title', 'Dashboard utilisateur')

@section('content')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #fff;
            font-family: 'Lato', 'Montserrat', Arial, sans-serif;
            line-height: 1.6;
            color: #222;
        }

        .dash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dash-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .dash-subtitle {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 26px;
            color: #444;
        }

        .dash-filters {
            background-color: rgba(89, 255, 216, 0.04);
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
            display: flex;
            align-items: flex-end;
            gap: 18px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .dash-filter-group {
            display: flex;
            flex-direction: column;
        }

        .dash-filter-label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .dash-filter-select {
            padding: 8px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            min-width: 150px;
            background: #fff;
        }

        .dash-filter-btn {
            background: #28d1b8;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 7px;
            padding: 10px 28px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            margin-bottom: 0;
            /* Pour bien aligner avec les selects */
            align-self: flex-end;
            height: 42px;
            display: flex;
            align-items: center;
        }

        .dash-filter-btn:hover {
            background: #1bbca3;
        }

        .dash-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-top: 24px;
            margin-bottom: 60px;
        }

        @media (max-width: 1100px) {
            .dash-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 700px) {
            .dash-cards-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .dash-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .dash-filter-btn {
                width: 100%;
                margin-left: 0;
            }
        }

        .dash-card {
            background-color: rgba(89, 255, 216, 0.04);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s ease-in-out;
        }

        .dash-card:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
        }

        .dash-card-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background: #eee;
        }

        .dash-card-content {
            padding: 18px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .dash-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .dash-card-dest,
        .dash-card-dates,
        .dash-card-status,
        .dash-card-cat {
            font-size: 0.97rem;
            margin: 3px 0;
            color: #444;
        }

        .dash-card-link {
            margin-top: 10px;
            display: inline-block;
            color: #28d1b8;
            background: none;
            padding: 0;
            text-decoration: underline;
            font-weight: 600;
            font-size: 0.99rem;
            transition: color 0.2s;
        }

        .dash-card-link:hover {
            color: #1bbca3;
        }
    </style>

    <div class="dash-container">
        <h1 class="dash-title">Bienvenue {{ auth()->user()->prenom }}</h1>
        <h2 class="dash-subtitle">Mes voyages</h2>

        <form method="GET" action="{{ route('dashboard') }}" class="dash-filters">
            <div class="dash-filter-group">
                <label for="status" class="dash-filter-label">Statut :</label>
                <select name="status" id="status" class="dash-filter-select">
                    <option value="">Tous</option>
                    <option value="a_venir" {{ request('status') == 'a_venir' ? 'selected' : '' }}>À venir</option>
                    <option value="en_route" {{ request('status') == 'en_route' ? 'selected' : '' }}>En route</option>
                    <option value="termine" {{ request('status') == 'termine' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>
            <div class="dash-filter-group">
                <label for="categorie" class="dash-filter-label">Catégorie :</label>
                <select name="categorie" id="categorie" class="dash-filter-select">
                    <option value="">Toutes</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id_categorie }}" {{ request('categorie') == $categorie->id_categorie ? 'selected' : '' }}>
                            {{ $categorie->titre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="dash-filter-btn"> Filtrer&nbsp;&nbsp; <i class="fa-solid fa-filter"></i> </button>
        </form>

        <div class="dash-cards-grid">
            @forelse ($voyages as $voyage)
                <div class="dash-card">
                    <img src="{{ $voyage->image_couverture ?? asset('assets/img_default.jpg') }}"
                        alt="Image {{ $voyage->nom_voyage }}" class="dash-card-img">
                    <div class="dash-card-content">
                        <h3 class="dash-card-title">{{ $voyage->nom_voyage }}</h3>
                        <p class="dash-card-dest"><strong>Destination :</strong> {{ $voyage->destination }}</p>
                        <p class="dash-card-dates"><strong>Dates :</strong> {{ $voyage->date_debut }} - {{ $voyage->date_fin }}
                        </p>
                        <p class="dash-card-status"><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $voyage->status)) }}</p>
                        <p class="dash-card-cat"><strong>Catégorie :</strong> {{ $voyage->categorie->titre ?? 'Non spécifiée' }}
                        </p>
                        <a href="{{ route('voyages.show', ['id_voyage' => $voyage->id_voyage]) }}" class="dash-card-link">Voir
                            le voyage</a>
                    </div>
                </div>
            @empty
                <p>Aucun voyage trouvé pour le moment.</p>
            @endforelse
        </div>
    </div>
@endsection