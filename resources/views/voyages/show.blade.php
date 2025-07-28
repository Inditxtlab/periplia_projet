@extends('layouts.app')

@section('content')

    <div style="width:100%;max-width:100vw;position:relative;margin-bottom:0;">
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

            .hero-voyage-cover-wrap {
                position: relative;
                width: 100%;
                overflow: hidden;
                min-height: 220px;
                max-height: 440px;
                height: 440px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hero-voyage-cover-img {
                width: 100%;
                height: 440px;
                object-fit: cover;
                display: block;
                max-height: 440px;
            }

            .hero-voyage-lock {
                position: absolute;
                top: 18px;
                right: 18px;
                z-index: 3;
                background: #fff;
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
                text-decoration: none;
                color: #ff855d;
                border: 1.5px solid #ffb48a;
                transition: background 0.2s;
            }

            .hero-voyage-lock:hover {
                background: #ffe5d6;
            }

            .hero-voyage-info-row {
                position: absolute;
                left: 0;
                bottom: 0;
                width: 100%;
                padding: 22px 36px 18px 36px;
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                background: linear-gradient(to top, rgba(255, 255, 255, 0.97) 70%, rgba(255, 255, 255, 0.6) 100%);
                font-size: 1rem;
                z-index: 2;
                cursor: pointer;
            }

            .hero-voyage-dest {
                font-weight: bold;
                color: #222;
            }

            .hero-voyage-countdown {
                font-weight: bold;
                color: #222;
            }

            .hero-voyage-delete-btn,
            .hero-voyage-edit-btn {
                background: #fff;
                color: #ff8559;
                border: 1.5px solid #ff8559;
                border-radius: 14px;
                padding: 10px 22px;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: background 0.2s, color 0.2s;
                box-shadow: 0 2px 8px rgba(255, 133, 93, 0.08);
                margin-right: 30px;
            }

            .hero-voyage-delete-btn:hover,
            .hero-voyage-edit-btn:hover {
                background: #ffe5d6;
                color: #ff6a2b;
            }

            .hero-voyage-delete-row {
                display: flex;
                justify-content: flex-end;
                margin-top: 12px;
                margin-bottom: 24px;
            }

            .hero-voyage-info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 10px 14px 10px 14px;
                font-size: 1rem;
            }

            .hero-voyage-lock {
                top: 10px;
                right: 10px;
                width: 28px;
                height: 28px;
                font-size: 1.1rem;
            }

            .hero-voyage-delete-row {
                margin-top: 8px;
                margin-bottom: 16px;
            }

            /* Styles pour les jours scrollables */
            .jours-scroll-outer {
                width: 100%;
                overflow-x: auto;
                padding: 28px 0 16px 0;
                margin-top: 10px;
                -webkit-overflow-scrolling: touch;
            }

            .jours-scroll-row {
                display: flex;
                gap: 20px;
                padding: 0 20px;
                min-width: max-content;
            }

            .jour-colonne {
                background: #fff8f4;
                border-radius: 16px;
                box-shadow: 0 2px 12px #ffeede;
                padding: 18px 20px;
                min-width: 260px;
                max-width: 320px;
                flex: 0 0 auto;
                display: flex;
                flex-direction: column;
            }

            .jour-header {
                font-size: 1.08em;
                margin-bottom: 14px;
                font-weight: 600;
            }

            .jour-date {
                color: #bb9995;
                font-size: 0.9em;
                font-weight: normal;
            }

            .jour-activites {
                display: flex;
                flex-direction: column;
                gap: 14px;
                min-height: 200px;
            }

            .activite-carte {
                background: #fff;
                border: 1.2px solid #ffceb8;
                border-radius: 13px;
                box-shadow: 0 2px 8px #ffe3db;
                padding-top: 20px;
                position: relative;
            }

            .activite-emoji {
                font-size: 2em;
                background: #fff8f4;
                border-radius: 100px;
                border: 2px solid #ffb58a;
                display: flex;
                justify-content: center;
                margin: -40px auto 10px;
                width: 70px;
                height: 70px;
                align-items: center;
                box-shadow: 0 2px 8px #ffeede;
            }

            .activite-header {
                margin-top: 12px;
                padding: 0 12px 6px;
            }

            .activite-top {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            }

            .activite-body {
                padding: 0 12px 12px;
            }

            .btn-action {
                background: none;
                border: none;
                cursor: pointer;
                padding: 0 4px;
            }

            .btn-edit {
                color: #ffb75d;
            }

            .btn-delete {
                color: #e34c39;
            }

            .no-activite {
                text-align: center;
                color: #e3bbb1;
                font-size: 0.99em;
                margin-top: 30px;
            }

            .btn-add {
                font-size: 1.15em;
                color: #fff;
                background: #fa8d56;
                border: none;
                padding: 4px 14px;
                border-radius: 9px;
                margin-top: 12px;
                cursor: pointer;
            }

            /* Style modal */
            .modal-activite {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background: #fff;
                border-radius: 16px;
                padding: 24px;
                width: 90%;
                max-width: 500px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
            }

            /* Scrollbar personnalisée */
            .jours-scroll-outer::-webkit-scrollbar {
                height: 8px;
            }

            .jours-scroll-outer::-webkit-scrollbar-track {
                background: #fff8f4;
                border-radius: 10px;
            }

            .jours-scroll-outer::-webkit-scrollbar-thumb {
                background: #ffceb8;
                border-radius: 10px;
            }
        </style>

    @php
        $typesActivites = [
            'Visite culturelle', 'Lieu historique', 'Rencontre locale', 'Balade nature',
            'Randonnée', 'Activité sportive', 'Excursion', 'Concert ou spectacle',
            'Atelier / Cours', 'Repas', 'Détente / Spa', 'Hébergement',
            'Trajet', 'Location', 'Rendez-vous', 'Autre'
        ];
        $typeEmojis = [
            'Visite culturelle' => '🏛️', 'Lieu historique' => '🏯', 'Rencontre locale' => '👋',
            'Balade nature' => '🌳', 'Randonnée' => '🥾', 'Activité sportive' => '⚽️',
            'Excursion' => '🚌', 'Concert ou spectacle' => '🎭', 'Atelier / Cours' => '🎨',
            'Repas' => '🍽️', 'Détente / Spa' => '🧖', 'Hébergement' => '🏨',
            'Trajet' => '🚆', 'Location' => '🚗', 'Rendez-vous' => '🗓️', 'Autre' => '📍'
        ];
        $defaultEmoji = '📍';
    @endphp

    <div class="hero-voyage-cover-wrap">
        <img src="{{ $voyage->image_couverture ? asset($voyage->image_couverture) : asset('assets/img_default.jpg') }}"
             alt="Image couverture par défaut" class="hero-voyage-cover-img">

        <a href="#" class="hero-voyage-lock" data-id="{{ $voyage->id_voyage }}"
           data-visibilite="{{ $voyage->visibilite }}" id="btn-toggle-visibilite" title="Changer la visibilité">
            <i class="fa-solid {{ $voyage->visibilite ? 'fa-lock-open' : 'fa-lock' }}"></i>
        </a>

        <div class="hero-voyage-info-row">
            <span id="toggle-destination" data-original="Destination : {{ $voyage->destination }}"
                  data-description="{{ $voyage->description }}" class="hero-voyage-dest cursor-pointer font-bold">
                Destination : {{ $voyage->destination }}
            </span>
            <span class="hero-voyage-countdown">
                <b>Countdown</b> :
                <span id="countdown">
                    {{ \Carbon\Carbon::parse($voyage->date_debut)->diffForHumans(null, true) }}
                </span>
            </span>
        </div>
    </div>

    <div class="hero-voyage-delete-row">
        @auth
            @if (auth()->id() === $voyage->id_user)
                <a href="{{ route('voyages.edit', $voyage->id_voyage) }}" class="hero-voyage-edit-btn">
                    <i class="fa-solid fa-pen-to-square"></i> Modifier voyage
                </a>

                <form action="{{ route('voyages.destroy', $voyage->id_voyage) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Voulez-vous vraiment supprimer ce voyage ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hero-voyage-delete-btn">
                        <i class="fa-solid fa-trash"></i> Supprimer voyage
                    </button>
                </form>
            @endif
        @endauth
    </div>

    <div class="jours-scroll-outer">
        <div class="jours-scroll-row">
            @foreach($jours as $idx => $date)
                <div class="jour-colonne">
                    <div class="jour-header">
                        Jour {{ $idx + 1 }}<br>
                        <span class="jour-date">{{ \Carbon\Carbon::parse($date)->translatedFormat('d/m/Y') }}</span>
                    </div>

                    <div class="jour-activites">
                        @foreach($activitesParJour[$date] ?? [] as $a)
                            <div class="activite-carte">
                                <div class="activite-emoji" aria-label="{{ $a->type ?? 'Activité' }}">
                                    {{ $typeEmojis[$a->type ?? ''] ?? $defaultEmoji }}
                                </div>
                                <div class="activite-header">
                                    <div class="activite-top">
                                        <strong>{{ $a->titre }}</strong>
                                        <span>
                                            <button onclick="showEditForm({{ $a->id }})" class="btn-action btn-edit"
                                                    aria-label="Modifier l'activité">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <form action="{{ route('activites.destroy', $a) }}" method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Êtes vous sûr de vouloir supprimer cette activite?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-action btn-delete" aria-label="Supprimer l'activité">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                </div>
                                <div class="activite-body">
                                    <div><b>Lieu :</b> {{ $a->lieu ?? '-' }}</div>
                                    <div style="display:flex;justify-content:space-between;">
                                        <span><b>À partir :</b> {{ $a->heure_debut }}</span>
                                        <span><b>Jusqu'à :</b> {{ $a->heure_fin }}</span>
                                    </div>
                                    <div><b>Type :</b> {{ $a->type ?? '-' }}</div>
                                    @if($a->description)
                                        <div><strong>Description :</strong> {{ $a->description }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if(empty($activitesParJour[$date]))
                            <div class="no-activite">Aucune activité</div>
                        @endif
                    </div>

                    @auth
                        <div style="text-align:center;">
                            <button onclick="showAddForm('{{ $date }}')" class="btn-add">
                                <i class="fa-solid fa-plus"></i> Ajouter
                            </button>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>

    <!-- Formulaire modal ajout/édition -->
    <div id="form-activite" class="modal-activite">
        <div class="modal-content">
            <form method="POST" id="form-activite-form" action="{{ route('activites.store') }}">
                @csrf
                <input type="hidden" name="id_voyage" value="{{ $voyage->id_voyage }}">
                <input type="hidden" name="date" id="form-date" value="">

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input name="titre" id="titre" value="" class="form-control" placeholder="Titre de l'activité" required>
                </div>

                <div class="form-group">
                    <label for="heure_debut">Heure de début</label>
                    <input name="heure_debut" id="heure_debut" type="time" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="heure_fin">Heure de fin</label>
                    <input name="heure_fin" id="heure_fin" type="time" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lieu">Lieu</label>
                    <input name="lieu" id="lieu" value="" class="form-control" placeholder="Lieu de l'activité">
                </div>

                <div class="form-group">
                    <label for="type">Type d'activité</label>
                    <select name="type" id="type" class="form-control">
                        @foreach($typesActivites as $type)
                            <option value="{{ $type }}">{{ $type }} {{ $typeEmojis[$type] ?? '📍' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Description de l'activité"></textarea>
                </div>

                <div style="display:flex; justify-content:space-between; margin-top:20px;">
                    <button type="button" onclick="closeForm()" style="background:#e0e0e0; color:#333;">Annuler</button>
                    <button type="submit" style="background:#fa8d56;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle description <=> destination
        const el = document.getElementById('toggle-destination');
        const originalText = el.dataset.original;
        const descriptionText = el.dataset.description;
        el.addEventListener('click', () => {
            el.textContent = (el.textContent.trim() === originalText.trim()) ? descriptionText : originalText;
        });

        // Toggle visibilité
        const btnLock = document.getElementById('btn-toggle-visibilite');
        btnLock.addEventListener('click', function (e) {
            e.preventDefault();
            const voyageId = btnLock.dataset.id;
            const icon = btnLock.querySelector('i');
            fetch(`/voyages/${voyageId}/toggle-visibilite`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const nouvelleVisibilite = data.visibilite;
                    btnLock.dataset.visibilite = nouvelleVisibilite;
                    if (nouvelleVisibilite == 1) {
                        icon.classList.remove('fa-lock');
                        icon.classList.add('fa-lock-open');
                    } else {
                        icon.classList.remove('fa-lock-open');
                        icon.classList.add('fa-lock');
                    }
                } else {
                    alert('Erreur : ' + data.error);
                }
            })
            .catch(error => console.error('Erreur AJAX :', error));
        });

        // Fermer modal à l'échap et au clic hors modal
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeForm();
        });

        document.getElementById('form-activite').addEventListener('click', function (e) {
            if (e.target === this) closeForm();
        });
    });

    function showAddForm(date) {
        resetForm();
        document.getElementById('form-date').value = date;
        document.getElementById('form-activite-form').action = '{{ route("activites.store") }}';
        // Enlever _method PUT si présent
        const methodInput = document.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
        document.getElementById('form-activite').style.display = 'flex';
    }

    function showEditForm(id) {
        fetch(`/activites/${id}`)
            .then(response => response.json())
            .then(data => {
                resetForm();
                document.getElementById('form-date').value = data.date;
                document.getElementById('titre').value = data.titre;
                document.getElementById('heure_debut').value = data.heure_debut;
                document.getElementById('heure_fin').value = data.heure_fin;
                document.getElementById('lieu').value = data.lieu ?? '';
                document.getElementById('type').value = data.type ?? '';
                document.getElementById('description').value = data.description ?? '';

                // Changer l'action du formulaire
                const form = document.getElementById('form-activite-form');
                form.action = `/activites/${id}`;

                // Ajouter _method PUT si absent
                if (!document.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                document.getElementById('form-activite').style.display = 'flex';
            })
            .catch(error => {
                alert('Erreur lors du chargement de l\'activité.');
                console.error(error);
            });
    }

    function resetForm() {
        document.getElementById('form-activite-form').reset();
    }

    function closeForm() {
        document.getElementById('form-activite').style.display = 'none';
        resetForm();
    }
</script>

@endsection