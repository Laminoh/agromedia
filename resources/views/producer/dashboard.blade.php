<x-producer-layout title="Tableau de bord">
    <!-- Page Title -->
    <div class="mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Tableau de bord</h1>
        <p class="text-gray-600 mt-1">Bienvenue, {{ $user->name }} !</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-green-200 hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <span class="text-xl sm:text-2xl">📦</span>
                </div>
                <span class="text-green-600 text-xs sm:text-sm font-bold bg-green-100 px-2 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-green-800">{{ $products->count() }}</h3>
            <p class="text-green-600 text-xs sm:text-sm font-medium">Mes Produits</p>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-blue-200 hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <span class="text-xl sm:text-2xl">🛒</span>
                </div>
                <span class="text-blue-600 text-xs sm:text-sm font-bold bg-blue-100 px-2 py-1 rounded-full">+8%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-blue-800">{{ $orders->count() }}</h3>
            <p class="text-blue-600 text-xs sm:text-sm font-medium">Mes Commandes</p>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-purple-200 hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <span class="text-xl sm:text-2xl">📍</span>
                </div>
            </div>
            <h3 class="text-base sm:text-xl font-bold text-purple-800 truncate">{{ $user->location ?? 'Non définie' }}</h3>
            <p class="text-purple-600 text-xs sm:text-sm font-medium">Localisation</p>
        </div>

        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-amber-200 hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <span class="text-xl sm:text-2xl">⭐</span>
                </div>
                <span class="text-amber-600 text-xs sm:text-sm font-bold bg-amber-100 px-2 py-1 rounded-full">4.8</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-amber-800">{{ $products->where('is_validated', true)->count() }}</h3>
            <p class="text-amber-600 text-xs sm:text-sm font-medium">Produits validés</p>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800">📦 Mes derniers produits</h2>
                <a href="{{ route('producer.products.index') }}" class="text-green-600 hover:text-green-700 font-medium text-xs sm:text-sm flex items-center space-x-1">
                    <span>Voir tout</span>
                    <span>→</span>
                </a>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($products->take(6) as $product)
                        <div class="border border-gray-200 rounded-xl sm:rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 group">
                            <div class="relative">
                                @if($product->media->where('type', 'image')->first())
                                    <img src="{{ asset('storage/' . $product->media->where('type', 'image')->first()->path) }}"
                                         alt="{{ $product->title }}" class="w-full h-36 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-36 sm:h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400 text-3xl sm:text-4xl">🌾</span>
                                    </div>
                                @endif
                                <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                    @if($product->is_validated)
                                        <span class="bg-green-500 text-white text-xs px-2 sm:px-3 py-1 rounded-full font-medium">✓ Validé</span>
                                    @else
                                        <span class="bg-yellow-500 text-white text-xs px-2 sm:px-3 py-1 rounded-full font-medium">⏳ En attente</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 sm:p-4">
                                <h3 class="font-bold text-sm sm:text-lg text-gray-800 mb-1 truncate">{{ $product->title }}</h3>
                                <p class="text-gray-500 text-xs sm:text-sm mb-2">{{ $product->category ?? 'Non catégorisé' }}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-green-600 font-bold text-sm sm:text-lg">
                                        {{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix ND' }}
                                    </p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('producer.products.show', $product) }}" class="w-8 h-8 sm:w-9 sm:h-9 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors text-sm sm:text-base">
                                            👁️
                                        </a>
                                        <a href="{{ route('producer.products.edit', $product) }}" class="w-8 h-8 sm:w-9 sm:h-9 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-600 hover:text-white transition-colors text-sm sm:text-base">
                                            ✏️
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-8 sm:p-12 text-center bg-gradient-to-br from-green-50 to-emerald-50">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-100 to-emerald-200 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 animate-bounce">
                    <span class="text-4xl sm:text-5xl">📦</span>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-green-800 mb-2">Commencez votre parcours !</h3>
                <p class="text-green-600 mb-4 sm:mb-6 text-sm sm:text-base">Ajoutez votre premier produit pour commencer à vendre</p>
                <a href="{{ route('producer.products.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-600 text-green-800 px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium hover:shadow-xl hover:scale-105 transition-all text-sm sm:text-base shadow-lg">
                    <span>➕</span>
                    <span>Créer mon premier produit</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Recent Orders -->
    @if($orders->count() > 0)
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden mt-6 sm:mt-8">
        <div class="p-4 sm:p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800">🛒 Commandes récentes</h2>
                <a href="#" class="text-green-600 hover:text-green-700 font-medium text-xs sm:text-sm flex items-center space-x-1">
                    <span>Voir tout</span>
                    <span>→</span>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-6">
            <div class="space-y-3 sm:space-y-4">
                @foreach($orders->take(5) as $order)
                    <div class="flex items-center justify-between p-3 sm:p-4 bg-gray-50 rounded-lg sm:rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                                <span class="text-xl sm:text-2xl">🛒</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Commande #{{ $order->id }}</h4>
                                <p class="text-xs sm:text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                @if($order->status === 'completed') Complétée
                                @elseif($order->status === 'pending') En attente
                                @else {{ ucfirst($order->status) }} @endif
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</x-producer-layout>
