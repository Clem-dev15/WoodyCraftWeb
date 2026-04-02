<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WoodyCraft</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- CONTENU --}}
    <main class="container mx-auto py-8">
        @yield('content')
    </main>

</body>
</html>