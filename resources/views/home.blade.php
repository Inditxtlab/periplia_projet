
@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="header-section">
    <div class="header-bg">
        <img src="{{ asset('assets/img_hero.png') }}" alt="Illustration voyage autour du monde" class="header-img">
    </div>
    <div class="header-btn">
        <a href="#" class="btn-discover">Découvrez Periplia</a>
    </div>
</div>

<section class="why-section">
    <h1>Pourquoi choisir Periplia&nbsp;?</h1>
    <p class="subtitle">
        Une plateforme pensée pour simplifier l’organisation de vos voyages en groupe
    </p>
    <div class="why-cards">
        <div class="why-card">
            <img src="{{ asset('assets/icon-group.svg') }}" alt="" class="why-icon">
            <h3>Un outil dédié au voyage en groupe</h3>
            <p>Plus besoin de jongler entre plusieurs apps.</p>
        </div>
        <div class="why-card">
            <img src="{{ asset('assets/icon-interactive.svg') }}" alt="" class="why-icon">
            <h3>Une expérience fluide et interactive</h3>
            <p>Chaque membre peut contribuer sans friction.</p>
        </div>
        <div class="why-card">
            <img src="{{ asset('assets/icon-modern.svg') }}" alt="" class="why-icon">
            <h3>Pensé pour les voyageurs modernes</h3>
            <p>Entre amis, en famille ou en groupe pro, tout devient plus simple.</p>
        </div>
    </div>
</section>

<section class="voyages-section">
    <h2>Explorez nos voyages</h2>
    <div class="voyages-carousel">
        @forelse($voyages as $voyage)
    <div class="voyage-card">
        <img src="{{ $voyage->image_url }}" alt="{{ $voyage->titre }}">
        <div class="voyage-title">{{ $voyage->titre }}</div>
    </div>
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
