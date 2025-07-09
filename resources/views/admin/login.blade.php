@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <h1>Connexion Admin</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <input type="email" name="email" placeholder="Email admin" required />
    <input type="password" name="password" placeholder="Mot de passe" required />
    <button type="submit">Se connecter Admin</button>
</form>
</body>
</html>

@endsection