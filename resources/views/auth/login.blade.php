@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('assets/logo_black.png') }}" alt="logo">
            <png width="50" height="40" ...></png>
            <div class="login-title">Connexion</div>
        </div>
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <label for="email">E-mail : *</label>
            <input type="email" name="email" id="email" required />
            
            <label for="password">Mot de passe : *</label>
            <input type="password" name="password" id="password" required />

            <div class="social-login">
                <span>Connectez-vous avec :</span>
                <a href="#" class="social-btn google"></a>
                <a href="#" class="social-btn facebook"></a>
            </div>

            <button type="submit" class="login-btn">Connecter</button>
        </form>
        <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
        </div>
        <div class="register_form">
                <a href="{{('register')}}">Pas encore inscrit ? Créez votre compte</a>
            </div>
    </div>
</div>

@endsection