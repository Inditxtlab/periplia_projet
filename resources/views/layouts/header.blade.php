<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo_periplia.svg') }}" alt="Logo" class="navbar-logo">
        </a>
        <span class="navbar-title">periplia</span>

        @if(auth('web')->check() || auth('admin')->check())
            {{-- Message de bienvenue visible uniquement si l'utilisateur est connecté --}}
            <span class="bienvenue">
                Bienvenue, {{ auth('web')->check() ? Auth::user()->prenom : auth('admin')->user()->email }}
            </span>
        @endif
    </div>

    <div class="navbar-right">
        <a href="{{ route('voyages.create') }}" class="navbar-btn">Créer un voyage</a>

        @auth('web')
            <a href="{{ route('dashboard') }}" class="navbar-btn">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-btn">Déconnexion</button>
            </form>
            {{-- Avatar utilisateur connecté (placé après le bouton de déconnexion) --}}
            <div class="avatar_user">
                <a href="{{ route('profile.show') }}">
                    <img class="photo_user" src="{{ Auth::user()->photo_profil ?? asset('assets/default-avatar.png') }}"
                        alt="Avatar">
                </a>
            </div>
        @elseif(auth('admin')->check())
            <a href="{{ route('admin.dashboard') }}" class="navbar-btn">Dashboard</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-btn">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="navbar-btn">Connexion</a>
        @endauth
    </div>
</nav>