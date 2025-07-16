@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="header-section">
        <div class="header-bg">
            <img src="{{ asset('assets/img_hero.png') }}" alt="Illustration voyage autour du monde" class="header-img">
        </div>
        <div class="header-btn">
            <a href="{{ route('register') }}" class="btn-discover">Découvrez Periplia <i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>

    <section class="why-section">
        <h1>Pourquoi choisir Periplia&nbsp;?</h1>
        <p class="subtitle">
            Une plateforme pensée pour simplifier l’organisation de vos voyages en groupe
        </p>
        <div class="why-cards">
            <div class="why-card">
                <img src="{{ asset('assets/icon_people.svg') }}" alt="Un outil dédié au voyage en groupe" class="why-icon">
                <h3>Un outil dédié au voyage en groupe</h3>
                <p>Plus besoin de jongler entre plusieurs apps.</p>
            </div>
            <div class="why-card">
                <img src="{{ asset('assets/icon_interactivite.svg') }}" alt="Une expérience fluide et interactive"
                    class="why-icon">
                <h3>Une expérience fluide et interactive</h3>
                <p>Chaque membre peut contribuer sans friction.</p>
            </div>
            <div class="why-card">
                <img src="{{ asset('assets/icon_voyageurs.svg') }}" alt="Pensé pour les voyageurs modernes"
                    class="why-icon">
                <h3>Pensé pour les voyageurs modernes</h3>
                <p>Entre amis, en famille ou en groupe pro, tout devient plus simple.</p>
            </div>
        </div>
    </section>

    <section class="voyages-section">
        <h2>Explorez nos voyages</h2>
        <div class="voyages-carousel">
            @forelse($voyages as $voyage)
                    <a href="{{ route('voyages.show', ['id_voyage' => $voyage->id_voyage]) }}" class="voyage-card">
                        <img src="{{ $voyage->image_couverture ?: asset('assets/img_default.jpg') }}"
                            alt="{{ $voyage->nom_voyage }}">
                        <div class="voyage-title">{{ $voyage->nom_voyage }}</div>
                    </a>
            @empty
                <p>Aucun voyage disponible pour le moment.</p>
            @endforelse
        </div>
        <div class="carousel-arrows">
            <span class="arrow">&lt;</span>
            <span class="arrow">&gt;</span>
        </div>
    </section>
@endsection