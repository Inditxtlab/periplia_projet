@extends('layouts.app')

@section('content')
    <style>
        .password-container {
            background: #fdf6f3;
            border: 1.2px solid #ffbe92;
            border-radius: 16px;
            max-width: 700px;
            margin: 38px auto;
            padding: 40px 34px 28px 34px;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .password-container h2 {
            text-align: center;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 35px;
            color: #211c18;
            letter-spacing: 1px;
        }

        .password-container form {
            display: flex;
            flex-direction: column;
            gap: 19px;
        }

        .password-container label {
            display: block;
            font-weight: 500;
            font-size: 1.05rem;
            color: #36312e;
            margin-bottom: 6px;
            letter-spacing: 0.1px;
        }

        .password-container input[type="password"] {
            width: 100%;
            padding: 11px 16px;
            border: 1.3px solid #d1bcae;
            border-radius: 8px;
            font-size: 1.1rem;
            font-family: inherit;
            background: #fff;
            box-sizing: border-box;
            color: #4e463e;
            outline: none;
            margin-bottom: 2px;
            transition: border-color 0.2s;
        }

        .password-container input[type="password"]:focus {
            border-color: #ff9157;
            background: #fcf4ee;
        }

        .password-container button[type="submit"] {
            margin-left: auto;
            margin-right: 0;
            margin-top: 15px;
            padding: 13px 46px;
            background: #ff9157;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.14rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 12px #ffeede;
            transition: background 0.18s, transform 0.12s;
            letter-spacing: 0.3px;
        }

        .password-container button[type="submit"]:hover {
            background: #fa803b;
            transform: scale(1.035);
        }

        @media (max-width: 700px) {
            .password-container {
                padding: 18px 3vw;
                border-radius: 10px;
            }

            .password-container h2 {
                font-size: 1.2rem;
            }
        }
    </style>
    <div class="container password-container">
        <h2>Changer le mot de passe</h2>
        <form action="{{ route('user.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Ancien mot de passe -->
            <label>Mot de passe actuel :</label>
            <input type="password" name="current_password" required>

            <!-- Nouveau mot de passe -->
            <label>Nouveau mot de passe :</label>
            <input type="password" name="password" required>

            <!-- Confirmation -->
            <label>Confirmer le mot de passe :</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Modifier le mot de passe</button>
        </form>
    </div>
@endsection