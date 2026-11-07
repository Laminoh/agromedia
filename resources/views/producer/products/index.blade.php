<x-producer-layout title="Mes Produits">
    <!-- Page Title -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">📦 Mes Produits</h1>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Gérez votre catalogue de produits</p>
            </div>
            <a href="{{ route('producer.products.create') }}" class="mt-3 sm:mt-0 inline-flex items-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-600 text-green-800 px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium text-sm sm:text-base">
                <span>➕</span>
                <span>Ajouter un produit</span>
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg sm:rounded-xl p-3 sm:p-4 border border-green-100">
            <div class="text-xl sm:text-2xl font-bold text-green-600">{{ $products->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-500">Total</div>
        </div>
        <div class="bg-white rounded-lg sm:rounded-xl p-3 sm:p-4 border border-green-100">
            <div class="text-xl sm:text-2xl font-bold text-green-600">{{ $products->where('is_validated', true)->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-500">Validés</div>
        </div>
        <div class="bg-white rounded-lg sm:rounded-xl p-3 sm:p-4 border border-yellow-100">
            <div class="text-xl sm:text-2xl font-bold text-yellow-600">{{ $products->where('is_validated', false)->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-500">En attente</div>
        </div>
        <div class="bg-white rounded-lg sm:rounded-xl p-3 sm:p-4 border border-blue-100">
            <div class="text-xl sm:text-2xl font-bold text-blue-600">{{ $products->where('is_validated', true)->sum('price') ? number_format($products->where('is_validated', true)->sum('price'), 0, ',', ' ') : 0 }}</div>
            <div class="text-xs sm:text-sm text-gray-500">Valeur totale (FCFA)</div>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($products as $product)
                        <div class="border border-gray-200 rounded-xl sm:rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <div class="relative">
                                @if($product->media->where('type', 'image')->first())
                                    <img src="{{ $product->media->where('type', 'image')->first()->url }}"
                                         alt="{{ $product->title }}" class="w-full h-32 sm:h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-32 sm:h-40 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <span class="text-3xl sm:text-4xl">🌾</span>
                                    </div>
                                @endif
                                <div class="absolute top-2 sm:top-3 right-2 sm:right-3 flex gap-1 sm:gap-2">
                                    @if($product->is_validated)
                                        <span class="bg-green-500 text-white text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full font-medium shadow-lg">✓ Validé</span>
                                    @else
                                        <span class="bg-yellow-500 text-white text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full font-medium shadow-lg">⏳ En attente</span>
                                    @endif
                                </div>
                                <div class="absolute bottom-2 sm:bottom-3 left-2 sm:left-3">
                                    @if($product->media->where('type', 'video')->count() > 0)
                                        <span class="bg-blue-500 text-white text-xs px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full font-medium shadow-lg">🎥 {{ $product->media->where('type', 'video')->count() }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 sm:p-4">
                                <h3 class="font-bold text-base sm:text-lg text-gray-800 mb-1 truncate">{{ $product->title }}</h3>
                                <p class="text-gray-500 text-xs sm:text-sm mb-2">{{ $product->category ?? 'Non catégorisé' }}</p>

                                <div class="flex items-center justify-between mb-2 sm:mb-3">
                                    <p class="text-green-600 font-bold text-base sm:text-xl">
                                        {{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix ND' }}
                                    </p>
                                    @if($product->location)
                                        <span class="text-gray-400 text-xs hidden sm:inline-flex">📍 {{ $product->location }}</span>
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('producer.products.show', $product) }}" class="flex-1 bg-blue-100 text-blue-600 text-center py-2 sm:py-2.5 rounded-lg sm:rounded-xl hover:bg-blue-600 hover:text-white transition-colors font-medium text-xs sm:text-sm">
                                        👁️ Voir
                                    </a>
                                    <a href="{{ route('producer.products.edit', $product) }}" class="flex-1 bg-green-100 text-green-600 text-center py-2 sm:py-2.5 rounded-lg sm:rounded-xl hover:bg-green-600 hover:text-white transition-colors font-medium text-xs sm:text-sm">
                                        ✏️ Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-8 sm:p-12 text-center">
            <div class="w-16 h-16 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                <span class="text-4xl sm:text-5xl">📦</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Aucun produit</h3>
            <p class="text-gray-500 mb-4 sm:mb-6 max-w-md mx-auto text-sm sm:text-base">Vous n'avez pas encore publié de produits. Commencez par ajouter votre premier produit pour atteindre plus de clients.</p>
            <a href="{{ route('producer.products.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-600 text-green-800 px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium text-sm sm:text-base">
                <span>➕</span>
                <span>Créer mon premier produit</span>
            </a>
        </div>
    @endif
</x-producer-layout>
