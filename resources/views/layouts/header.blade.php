<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo_periplia.svg') }}" alt="Logo" class="navbar-logo">
            </a>
            <span class="navbar-title">periplia</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('voyages.create') }}" class="navbar-btn">Creer un voyage</a>
        <a href="{{ route('login') }}" class="navbar-btn">Connexion</a>
    </div>
</nav>