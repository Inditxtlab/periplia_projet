<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo_periplia.svg') }}" alt="Logo" class="navbar-logo">
        </a>
        <span class="navbar-title">periplia</span>
    </div>

    <div class="navbar-right">
        <a href="{{ route('voyages.create') }}" class="navbar-btn">Créer un voyage</a>

        @auth('web') 
            <a href="{{ route('dashboard') }}" class="navbar-btn">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-btn" style="background:none; border:none; cursor:pointer;">
                    Déconnexion
                </button>
            </form>
        @elseif(auth('admin')->check())
            <a href="{{ route('admin.dashboard') }}" class="navbar-btn">Admin</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-btn" style="background:none; border:none; cursor:pointer;">
                    Déconnexion
                </button>
            </form>
        @else 
            <a href="{{ route('login') }}" class="navbar-btn">Connexion</a>
        @endauth
    </div>
</nav>
