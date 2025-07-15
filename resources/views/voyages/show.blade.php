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
            </style>


            <div class="hero-voyage-cover-wrap">
                <img src="{{ $voyage->image_couverture ?? asset('assets/img_default.jpg') }}" alt="Image couverture"
                    class="hero-voyage-cover-img">

                <!-- Icône cadenas (confidentialité) -->
                <!-- ce lien déclenche un changement de visibilité sans recharger la page, avec des données dynamiques grâce aux data-*. -->
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

    // PATCH	Utilisé pour modifier une seule donnée (visibilite) plutôt qu’un objet entier.
    // fetch	API moderne pour faire des appels HTTP sans jQuery.
    // X-CSRF-TOKEN	Laravel protège toutes ses routes POST/PATCH/DELETE avec un token CSRF, pour éviter les attaques.
    // data-*	On utilise des attributs HTML personnalisés (data-id, data-visibilite) pour transmettre facilement des infos au JS.
    // classList.add/remove	Permet de changer dynamiquement l’apparence sans recharger la page.
    // .catch()	Permet de gérer proprement les erreurs si le serveur ne répond pas.

                document.addEventListener('DOMContentLoaded', function () {
                    const btnLock = document.getElementById('btn-toggle-visibilite');

                    btnLock.addEventListener('click', function (e) {
                        e.preventDefault(); // On empêche le lien de rediriger

                        const voyageId = btnLock.dataset.id;
                        const icon = btnLock.querySelector('i'); // On cible l’icône <i> dans le lien

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

                                    // Changement d’icône selon nouvelle visibilité
                                    if (nouvelleVisibilite == 1) {
                                        icon.classList.remove('fa-lock');
                                        icon.classList.add('fa-lock-open');
                                    } else {
                                        icon.classList.remove('fa-lock-open');
                                        icon.classList.add('fa-lock');
                                    }
                                } else {
                                    alert('Erreur : ' + data.error); // Message d'erreur si l’opération échoue
                                }
                            })
                            .catch(error => {
                                console.error('Erreur AJAX :', error); // Log si erreur réseau ou serveur
                            });
                    });
                });
            </script>
@endsection