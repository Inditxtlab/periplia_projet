<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Periplia')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Edu+TAS+Beginner:wght@400..700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chargement des fichiers CSS et JS via Vite -->
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/css/login.css', 'resources/css/register.css', 'resources/css/voyage.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.header') 
    <main>
        @yield('content') 
    </main>
    @include('layouts.footer') 
</body>

</html>