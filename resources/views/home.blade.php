<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGROMEDIA - Plateforme des producteurs agricoles</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #065f46 0%, #047857 50%, #10b981 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: scale(1.05);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .pulse-icon {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-8 h-8 object-contain">
                    </div>
                    <a href="/" class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                        AGROMEDIA
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors">
                            Mon Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-500 font-medium transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 font-medium">
                            Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/im1.jpg') }}" alt="Agriculture Sénégal" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/85 via-emerald-800/80 to-green-900/85"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="text-center fade-in">
                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium">
                    🌾 Plateforme #1 des producteurs agricoles au Sénégal
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Connectez-vous à la
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-amber-400">
                        terre locale
                    </span>
                </h1>
                <p class="text-xl text-green-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                    Plateforme de valorisation multimédia des producteurs agricoles du Sénégal. 
                    Promouvez vos produits, trouvez des clients, et soutenez l'agriculture locale.
                </p>
                
                @auth
                    <div class="flex justify-center gap-4 flex-wrap">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn-hover bg-white text-green-700 px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl flex items-center space-x-2">
                                <span>🛡️</span>
                                <span>Dashboard Admin</span>
                            </a>
                        @elseif(auth()->user()->role === 'producteur')
                            <a href="{{ route('producer.dashboard') }}" class="btn-hover bg-white text-green-700 px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl flex items-center space-x-2">
                                <span>📦</span>
                                <span>Dashboard Producteur</span>
                            </a>
                        @else
                            <a href="{{ route('client.products.index') }}" class="btn-hover bg-white text-green-700 px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl flex items-center space-x-2">
                                <span>🛒</span>
                                <span>Voir les produits</span>
                            </a>
                        @endif
                    </div>
                @else
                    <div class="flex justify-center gap-4 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-hover bg-white text-green-700 px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl flex items-center space-x-2">
                            <span>S'inscrire gratuitement</span>
                        </a>
                        <a href="{{ route('login') }}" class="btn-hover bg-transparent border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-green-700 transition-all duration-300 flex items-center space-x-2">
                            <span>🔑</span>
                            <span>Se connecter</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f0fdf4"/>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    @guest
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Pourquoi choisir AGROMEDIA ?</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Une plateforme complète pour transformer l'agriculture sénégalaise
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Producteurs Card -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-green-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg pulse-icon">
                        <span class="text-4xl">👨‍🌾</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Pour les Producteurs</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Publiez vos produits avec des images et vidéos pour atteindre plus de clients et augmenter vos ventes.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-center space-x-2">
                            <span class="text-green-500">✓</span>
                            <span>Galerie multimédia</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-green-500">✓</span>
                            <span>Profil personnalisable</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-green-500">✓</span>
                            <span>Gestion des commandes</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Clients Card -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-blue-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg pulse-icon">
                        <span class="text-4xl">🛒</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Pour les Clients</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Trouvez facilement des produits agricoles frais et contactez directement les producteurs via WhatsApp.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-center space-x-2">
                            <span class="text-blue-500">✓</span>
                            <span>Recherche multi-critères</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-blue-500">✓</span>
                            <span>Contact WhatsApp direct</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-blue-500">✓</span>
                            <span>Produits vérifiés</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Accessibilité Card -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-purple-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg pulse-icon">
                        <span class="text-4xl">🔊</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Accessible à tous</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Boutons audio pour aider les utilisateurs analphabètes à naviguer facilement sur la plateforme.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-center space-x-2">
                            <span class="text-purple-500">✓</span>
                            <span>Guides audio intégrés</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-purple-500">✓</span>
                            <span>Interface iconique</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-purple-500">✓</span>
                            <span>Navigation simplifiée</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endguest

    <!-- Stats Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">500+</div>
                    <div class="text-gray-600">Producteurs</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">2000+</div>
                    <div class="text-gray-600">Produits</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">10000+</div>
                    <div class="text-gray-600">Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">14</div>
                    <div class="text-gray-600">Régions</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-8 h-8 object-contain">
                        </div>
                        <span class="text-xl font-bold">AGROMEDIA</span>
                    </div>
                    <p class="text-gray-400">
                        Plateforme de valorisation multimédia des producteurs agricoles du Sénégal.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-green-400 transition-colors">À propos</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Comment ça marche</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📍 Dakar, Sénégal</li>
                        <li>📧 contact@agromedia.sn</li>
                        <li>📱 +221 77 000 00 00</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>© 2024 AGROMEDIA - Plateforme des producteurs agricoles du Sénégal. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
