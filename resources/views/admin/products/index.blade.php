<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Validation des produits
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">📦 Validation des produits</h1>
                    <p class="text-gray-500 mt-1">{{ $products->count() }} produit(s) à valider</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                    <span>←</span>
                    <span class="ml-1">Retour au dashboard</span>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                @php
                    $pendingProducts = $products->where('is_validated', false);
                    $validatedProducts = $products->where('is_validated', true);
                @endphp
                <div class="bg-white rounded-xl p-4 border-l-4 border-yellow-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">En attente de validation</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $pendingProducts->count() }}</p>
                        </div>
                        <span class="text-3xl">⏳</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border-l-4 border-green-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Produits validés</p>
                            <p class="text-2xl font-bold text-green-600">{{ $validatedProducts->count() }}</p>
                        </div>
                        <span class="text-3xl">✓</span>
                    </div>
                </div>
            </div>

            <!-- Produits en attente -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-2">⏳</span>
                        Produits en attente de validation
                    </h2>
                    <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full font-medium">{{ $pendingProducts->count() }}</span>
                </div>

                @if($pendingProducts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pendingProducts as $product)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all">
                                <div class="relative">
                                    @if($product->media->where('type', 'image')->first())
                                        <img src="{{ asset('storage/' . $product->media->where('type', 'image')->first()->path) }}" 
                                             alt="{{ $product->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <span class="text-5xl">🌾</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-lg">⏳ En attente</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg text-gray-800 mb-1 truncate">{{ $product->title }}</h3>
                                    <p class="text-gray-500 text-sm mb-2">{{ $product->category ?? 'Non catégorisé' }}</p>
                                    
                                    <div class="flex items-center gap-2 mb-3 p-2 bg-gray-50 rounded-lg">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($product->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                                    </div>

                                    <p class="text-green-600 font-bold text-xl mb-3">
                                        {{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix ND' }}
                                    </p>

                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.products.validate', $product) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-1">
                                                <span>✓</span>
                                                <span>Valider</span>
                                            </button>
                                        </form>
                                        <a href="#" class="flex-1 bg-red-100 text-red-600 text-center py-3 rounded-xl hover:bg-red-200 transition-colors font-medium flex items-center justify-center space-x-1">
                                            <span>✗</span>
                                            <span>Refuser</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">✓</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tout est à jour !</h3>
                        <p class="text-gray-500">Aucun produit en attente de validation</p>
                    </div>
                @endif
            </div>

            <!-- Produits validés -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2">✓</span>
                        Produits validés
                    </h2>
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">{{ $validatedProducts->count() }}</span>
                </div>

                @if($validatedProducts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($validatedProducts as $product)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden opacity-75 hover:opacity-100 transition-opacity">
                                <div class="relative">
                                    @if($product->media->where('type', 'image')->first())
                                        <img src="{{ asset('storage/' . $product->media->where('type', 'image')->first()->path) }}" 
                                             alt="{{ $product->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <span class="text-5xl">🌾</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-lg">✓ Validé</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg text-gray-800 mb-1 truncate">{{ $product->title }}</h3>
                                    <p class="text-gray-500 text-sm mb-2">{{ $product->category ?? 'Non catégorisé' }}</p>
                                    
                                    <div class="flex items-center gap-2 mb-3 p-2 bg-gray-50 rounded-lg">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($product->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                                    </div>

                                    <p class="text-green-600 font-bold text-xl mb-3">
                                        {{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix ND' }}
                                    </p>

                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span>{{ $product->created_at->format('d/m/Y') }}</span>
                                        <a href="{{ route('client.products.show', $product) }}" target="_blank" class="text-green-600 hover:text-green-700 font-medium">Voir →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">📦</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun produit validé</h3>
                        <p class="text-gray-500">Les produits validés apparaîtront ici</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
