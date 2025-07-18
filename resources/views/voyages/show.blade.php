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
                padding: 10px 12px;
            }

            .activite-top {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            }

            .btn-action {
                background: none;
                border: none;
                color: #ff8559;
                cursor: pointer;
                padding: 0 4px;
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
                width: 100%;
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

            ul {
                list-style: none;
                padding: 0;
            }

            li {
                margin: 7px 0;
            }

            button {
                border-radius: 9px;
                border: none;
                background: #ffd1bb;
                color: #fff;
                padding: 5px 13px;
                margin-left: 8px;
            }

            button:hover {
                background: #ff873a;
                color: #fff;
            }
        </style>


        <div class="hero-voyage-cover-wrap">
            <img src="{{ $voyage->image_couverture ?? asset('assets/img_default.jpg') }}" alt="Image couverture"
                class="hero-voyage-cover-img">

            <!-- Icône cadenas (confidentialité) -->
            <a href="#" class="hero-voyage-lock" data-id="{{ $voyage->id_voyage }}"
                data-visibilite="{{ $voyage->visibilite }}" id="btn-toggle-visibilite" title="Changer la visibilité">
                <i class="fa-solid {{ $voyage->visibilite ? 'fa-lock-open' : 'fa-lock' }}"></i>
            </a>

            <!-- Infos sur l'image -->
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
                    <!-- Bouton Modifier -->
                    <a href="{{ route('voyages.edit', $voyage->id_voyage) }}" class="hero-voyage-edit-btn">
                        <i class="fa-solid fa-pen-to-square"></i> Modifier voyage
                    </a>

                    <!-- Formulaire de suppression -->
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

        <!-- Section des jours scrollable -->
        <div class="jours-scroll-outer">
            <div class="jours-scroll-row">
                @foreach($jours as $idx => $date)
                    <div class="jour-colonne">
                        <div class="jour-header">
                            Jour {{ $idx + 1 }}<br>
                            <span class="jour-date">Date {{ \Carbon\Carbon::parse($date)->translatedFormat('d/m/Y') }}</span>
                        </div>

                        <div class="jour-activites">
                            @foreach($activitesParJour[$date] ?? [] as $a)
                                <div class="activite-carte">
                                    <div class="activite-top">
                                        <strong>{{ $a->titre }}</strong>
                                        <span>
                                            <button onclick="showEditForm({{ $a->id }})" class="btn-action"
                                                style="color:#ffb75d;">✏️</button>
                                            <form action="{{ route('activites.destroy', $a) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action">🗑️</button>
                                            </form>
                                        </span>
                                    </div>
                                    <div><b>Lieu:</b> {{ $a->lieu ?? '-' }}</div>
                                    <div><b>Heure:</b> {{ $a->heure_debut }} → {{ $a->heure_fin }}</div>
                                    <div><b>Type d'activite:</b> {{ $a->type ?? '-' }}</div>
                                    <div><strong>Description :</strong> {{ $a->description }}</div>
                                </div>
                            @endforeach

                            @if(empty($activitesParJour[$date]))
                                <div class="no-activite">Aucune activité</div>
                            @endif
                        </div>

                        @auth
                            <div style="text-align:center;">
                                <button onclick="showAddForm('{{ $date }}')" class="btn-add">+ Ajouter</button>
                            </div>
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Formulaire d'ajout/édition modal -->
        <div id="form-activite" class="modal-activite">
            <div class="modal-content">
                <form method="POST" action="{{ route('activites.store') }}">
                    @csrf
                    <input type="hidden" name="id_voyage" value="{{ $voyage->id_voyage }}">
                    <input type="hidden" name="date" id="form-date">

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input name="titre" id="titre" value="{{ old('titre') }}" class="form-control"
                            placeholder="Titre de l'activité" required>

                    </div>
                    <div class="form-group">
                        <label for="heure_debut">Heure de début</label>
                        <input name="heure_debut" id="heure_debut" value="{{ old('heure_debut') }}" type="time"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="heure_fin">Heure de fin</label>
                        <input name="heure_fin" id="heure_fin" value="{{ old('heure_fin') }}" type="time"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="lieu">Lieu</label>
                        <input name="lieu" id="lieu" value="{{ old('lieu') }}" class="form-control"
                            placeholder="Lieu de l'activité">
                    </div>

                    <div class="form-group">
                        <label for="type">Type d'activité</label>
                        <select name="type" class="form-control">
                            @foreach($typesActivites as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            placeholder="Description de l'activité">{{ old('description') }}</textarea>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-top:20px;">
                        <button type="button" onclick="document.getElementById('form-activite').style.display='none'"
                            style="background:#e0e0e0; color:#333;">Annuler</button>
                        <button type="submit" style="background:#fa8d56;">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Javascript - Description et visibilité  -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const el = document.getElementById('toggle-destination');

                const originalText = el.dataset.original;
                const descriptionText = el.dataset.description;

                el.addEventListener('click', () => {
                    // Si le contenu actuel est le texte d'origine → on remplace par la description
                    if (el.textContent.trim() === originalText.trim()) {
                        el.textContent = descriptionText;
                    } else {
                        el.textContent = originalText;
                    }
                });
            });

            // PATCH	Utilisé pour modifier une seule donnée (visibilite) plutôt qu'un objet entier.
            // fetch	API moderne pour faire des appels HTTP sans jQuery.
            // X-CSRF-TOKEN	Laravel protège toutes ses routes POST/PATCH/DELETE avec un token CSRF, pour éviter les attaques.
            // data-*	On utilise des attributs HTML personnalisés (data-id, data-visibilite) pour transmettre facilement des infos au JS.
            // classList.add/remove	Permet de changer dynamiquement l'apparence sans recharger la page.
            // .catch()	Permet de gérer proprement les erreurs si le serveur ne répond pas.

            document.addEventListener('DOMContentLoaded', function () {
                const btnLock = document.getElementById('btn-toggle-visibilite');

                btnLock.addEventListener('click', function (e) {
                    e.preventDefault(); // On empêche le lien de rediriger

                    const voyageId = btnLock.dataset.id;
                    const icon = btnLock.querySelector('i'); // On cible l'icône <i> dans le lien

                    fetch(`/voyages/${voyageId}/toggle-visibilite`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF pour la sécurité
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const nouvelleVisibilite = data.visibilite;

                                // Mise à jour de l'attribut data
                                btnLock.dataset.visibilite = nouvelleVisibilite;

                                // Changement d'icône selon nouvelle visibilité
                                if (nouvelleVisibilite == 1) {
                                    icon.classList.remove('fa-lock');
                                    icon.classList.add('fa-lock-open');
                                } else {
                                    icon.classList.remove('fa-lock-open');
                                    icon.classList.add('fa-lock');
                                }
                            } else {
                                alert('Erreur : ' + data.error); // Message d'erreur si l'opération échoue
                            }
                        })
                        .catch(error => {
                            console.error('Erreur AJAX :', error); // Log si erreur réseau ou serveur
                        });
                });
            });

            function showAddForm(date) {
                document.getElementById('form-activite').style.display = 'flex';
                document.getElementById('form-date').value = date;
            }

            function showEditForm(id) {
                // Appel AJAX pour récupérer les données de l'activité si nécessaire
                // Puis afficher le formulaire pré-rempli
                document.getElementById('form-activite').style.display = 'flex';
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.getElementById('form-activite').style.display = 'none';
                }
            });

            document.getElementById('form-activite').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });

        </script>
@endsection