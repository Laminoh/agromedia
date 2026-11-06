<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'AGROMEDIA - Espace Producteur' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="flex min-h-screen flex-col lg:flex-row">
            <!-- Sidebar -->
            <aside class="w-full lg:w-32 bg-gradient-to-b from-green-600 to-emerald-700 text-green-100 lg:sticky lg:top-0 lg:h-screen overflow-y-auto hidden lg:block z-40">
                <!-- Logo -->
                <div class="p-3 border-b border-green-500/30">
                    <a href="{{ route('producer.dashboard') }}" class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-6 h-6 object-contain">
                        <span class="text-[9px] font-bold text-green-100 mt-0.5">AGROMEDIA</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="p-2 space-y-1.5">
                    <!-- Dashboard -->
                    <a href="{{ route('producer.dashboard') }}"
                       title="Dashboard"
                       class="flex flex-col items-center justify-center w-10 mx-auto py-1.5 rounded-md transition-all duration-200 {{ request()->routeIs('producer.dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <span class="text-base text-green-100">📊</span>
                        <span class="font-medium text-green-100 text-[8px] text-center mt-0.5">Dash</span>
                    </a>

                    <!-- Mes Produits -->
                    <a href="{{ route('producer.products.index') }}"
                       title="Mes Produits"
                       class="flex flex-col items-center justify-center w-10 mx-auto py-1.5 rounded-md transition-all duration-200 {{ request()->routeIs('producer.products.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <span class="text-base text-green-100">📦</span>
                        <span class="font-medium text-green-100 text-[8px] text-center mt-0.5">Produits</span>
                    </a>

                    <!-- Ajouter Produit -->
                    <a href="{{ route('producer.products.create') }}"
                       title="Ajouter Produit"
                       class="flex flex-col items-center justify-center w-10 mx-auto py-1.5 rounded-md transition-all duration-200 hover:bg-white/10">
                        <span class="text-base text-green-100">➕</span>
                        <span class="font-medium text-green-100 text-[8px] text-center mt-0.5">Ajouter</span>
                    </a>

                    <!-- Mon Profil -->
                    <a href="{{ route('profile.edit') }}"
                       title="Mon Profil"
                       class="flex flex-col items-center justify-center w-10 mx-auto py-1.5 rounded-md transition-all duration-200 hover:bg-white/10">
                        <span class="text-base text-green-100">👤</span>
                        <span class="font-medium text-green-100 text-[8px] text-center mt-0.5">Profil</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-green-500/30 bg-green-700/50">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-lg">👨‍🌾</span>
                        </div>
                        <p class="font-medium text-green-100 text-xs truncate w-full">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-green-200 truncate w-full">Producteur</p>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Mobile Header -->
                <header class="lg:hidden bg-gradient-to-r from-green-600 to-emerald-600 text-white p-4 sticky top-0 z-50">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('producer.dashboard') }}" class="flex items-center space-x-2">
                            <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-6 h-6 object-contain">
                            <span class="font-bold">AGROMEDIA</span>
                        </a>
                        <div class="flex items-center space-x-2">
                            <a href="#" onclick="confirmLogout()" class="p-2 rounded-lg hover:bg-white/20">
                                <span class="text-xl">🏠</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg hover:bg-white/20">
                                    <span class="text-xl">🚪</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-4 sm:p-6 lg:p-8">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div id="logoutModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-6 max-w-md mx-4 shadow-2xl">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🚪</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Retour à l'accueil ?</h3>
                    <p class="text-gray-600 mb-6">Voulez-vous vous déconnecter avant de retourner à la page d'accueil ?</p>
                    <div class="flex gap-3">
                        <button onclick="closeModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                            Annuler
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:shadow-lg transition-all font-medium">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmLogout() {
                document.getElementById('logoutModal').classList.remove('hidden');
                document.getElementById('logoutModal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('logoutModal').classList.add('hidden');
                document.getElementById('logoutModal').classList.remove('flex');
            }
        </script>
    </body>
</html>
