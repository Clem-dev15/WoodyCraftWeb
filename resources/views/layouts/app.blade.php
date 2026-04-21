<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodyCraft</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white shadow border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- LOGO --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-4xl font-bold text-gray-800">
                        WoodyCraft
                    </a>
                </div>

                {{-- DROITE --}}
                <div class="flex items-center space-x-6">

                    {{-- PANIER --}}
                    <a href="{{ route('panier.index') }}" class="relative flex items-center text-gray-700 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M16 21a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>

                        <span class="text-sm font-medium">Panier</span>

                        @if($panierCount > 0)
                            <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold rounded-full min-w-[20px] h-5 px-1 flex items-center justify-center">
                                {{ $panierCount }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-black">Connexion</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-black">Inscription</a>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

</body>
</html>