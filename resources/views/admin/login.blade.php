@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
    background: #fff4ee;
">
    <div style="
        background: #fff7f1;
        border-radius: 18px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        padding: 40px 48px;
        min-width: 410px;
        border: 1px solid #ffe3d5;
        text-align: center;
    ">
        <div style="font-size: 1.5rem; font-weight: 600; margin-bottom: 26px;">Connexion Admin</div>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 16px; text-align:left;">
                <ul style="padding-left:15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" style="margin-bottom: 20px;">
            @csrf

            <div style="margin-bottom: 18px; text-align:left;">
                <label style="font-size: 0.99rem; font-weight:500; margin-bottom:7px; display:block;">E-mail&nbsp;: *</label>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Votre e-mail" 
                    required
                    style="width: 100%; border:1px solid #e1e1e1; border-radius:7px; padding:10px 12px; font-size:1rem; outline: none; margin:0; background: #fff;"
                />
            </div>

            <div style="margin-bottom: 22px; text-align:left;">
                <label style="font-size: 0.99rem; font-weight:500; margin-bottom:7px; display:block;">Mot de passe&nbsp;: *</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                    style="width: 100%; border:1px solid #e1e1e1; border-radius:7px; padding:10px 12px; font-size:1rem; outline: none; margin:0; background: #fff;"
                />
            </div>

            <button 
                type="submit"
                style="
                    width: 170px;
                    background:#ff8257;
                    color: #fff;
                    border:none;
                    border-radius: 14px;
                    padding:12px 10px;
                    font-size:1rem;
                    font-weight:600;
                    cursor:pointer;
                    transition:.2s;
                "
            >Connecter</button>
        </form>

        <div style="margin-top: 18px;">
                Mot de passe oublié ?
            </a>
        </div>
    </div>
</div>
@endsection