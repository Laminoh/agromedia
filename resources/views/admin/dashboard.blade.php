<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard Administrateur
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">🛡️ Panel Administrateur</h1>
                <p class="text-gray-500 mt-1">Gérez la plateforme AGROMEDIA</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Total Utilisateurs</p>
                            <p class="text-4xl font-bold text-blue-600">{{ $totalUsers }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                            <span class="text-3xl">👥</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Total Produits</p>
                            <p class="text-4xl font-bold text-green-600">{{ $totalProducts }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <span class="text-3xl">📦</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Produits en attente</p>
                            <p class="text-4xl font-bold text-yellow-600">{{ $pendingProducts }}</p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <span class="text-3xl">⏳</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Médias en attente</p>
                            <p class="text-4xl font-bold text-red-600">{{ $pendingMedia }}</p>
                        </div>
                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                            <span class="text-3xl">📷</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Actions rapides -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-2">⚡</span>
                        Actions rapides
                    </h3>
                    <div class="space-y-4">
                        <a href="{{ route('admin.users') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-4 rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2">
                            <span>👥</span>
                            <span>Gérer les utilisateurs</span>
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white text-center py-4 rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2">
                            <span>📦</span>
                            <span>Valider les produits</span>
                        </a>
                        @if($pendingProducts > 0)
                        <a href="{{ route('admin.products.index') }}" class="block w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-center py-4 rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2">
                            <span>🔔</span>
                            <span>{{ $pendingProducts }} produit(s) en attente</span>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Derniers utilisateurs -->
                <div class="bg-white rounded-2xl shadow-lg p-6 lg:col-span-2">
                    <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2">🆕</span>
                        Derniers utilisateurs inscrits
                    </h3>
                    <div class="space-y-3">
                        @php
                            $recentUsers = \App\Models\User::latest()->take(5)->get();
                        @endphp
                        @if($recentUsers->count() > 0)
                            @foreach($recentUsers as $user)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : ($user->role == 'producteur' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <span class="text-4xl">👥</span>
                                <p class="mt-2">Aucun utilisateur récent</p>
                            </div>
                        @endif
                    </div>
                    @if($recentUsers->count() > 0)
                    <div class="mt-4 text-center">
                        <a href="{{ route('admin.users') }}" class="text-green-600 hover:text-green-700 font-medium">Voir tous les utilisateurs →</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Statistiques supplémentaires -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-2">📊</span>
                        Répartition des utilisateurs
                    </h3>
                    @php
                        $adminCount = \App\Models\User::where('role', 'admin')->count();
                        $producerCount = \App\Models\User::where('role', 'producteur')->count();
                        $clientCount = \App\Models\User::where('role', 'client')->count();
                    @endphp
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Administrateurs</span>
                                <span class="text-sm font-semibold text-red-600">{{ $adminCount }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalUsers > 0 ? ($adminCount / $totalUsers * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Producteurs</span>
                                <span class="text-sm font-semibold text-green-600">{{ $producerCount }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalUsers > 0 ? ($producerCount / $totalUsers * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Clients</span>
                                <span class="text-sm font-semibold text-blue-600">{{ $clientCount }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $totalUsers > 0 ? ($clientCount / $totalUsers * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2">📈</span>
                        État des produits
                    </h3>
                    @php
                        $validatedCount = \App\Models\Product::where('is_validated', true)->count();
                        $pendingCount = \App\Models\Product::where('is_validated', false)->count();
                    @endphp
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Produits validés</span>
                                <span class="text-sm font-semibold text-green-600">{{ $validatedCount }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalProducts > 0 ? ($validatedCount / $totalProducts * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">En attente de validation</span>
                                <span class="text-sm font-semibold text-yellow-600">{{ $pendingCount }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $totalProducts > 0 ? ($pendingCount / $totalProducts * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @if($pendingCount > 0)
                    <div class="mt-6 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                        <p class="text-yellow-800 text-sm">
                            <span class="font-semibold">⚠️ {{ $pendingCount }} produit(s)</span> en attente de validation
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
