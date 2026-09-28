<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Gestion des utilisateurs
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">👥 Gestion des utilisateurs</h1>
                    <p class="text-gray-500 mt-1">{{ $users->count() }} utilisateur(s) inscrit(s)</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                    <span>←</span>
                    <span class="ml-1">Retour au dashboard</span>
                </a>
            </div>

            <!-- Stats par rôle -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                @php
                    $adminCount = $users->where('role', 'admin')->count();
                    $producerCount = $users->where('role', 'producteur')->count();
                    $clientCount = $users->where('role', 'client')->count();
                @endphp
                <div class="bg-white rounded-xl p-4 border-l-4 border-red-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Administrateurs</p>
                            <p class="text-2xl font-bold text-red-600">{{ $adminCount }}</p>
                        </div>
                        <span class="text-3xl">🛡️</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border-l-4 border-green-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Producteurs</p>
                            <p class="text-2xl font-bold text-green-600">{{ $producerCount }}</p>
                        </div>
                        <span class="text-3xl">👨‍🌾</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border-l-4 border-blue-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Clients</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $clientCount }}</p>
                        </div>
                        <span class="text-3xl">🛒</span>
                    </div>
                </div>
            </div>

            <!-- Tableau utilisateurs -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rôle</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Téléphone</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Localisation</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : ($user->role == 'producteur' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->phone ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->location ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @if($user->whatsapp_number)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->whatsapp_number) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                                                    <span class="mr-1">📱</span>
                                                    <span>WhatsApp</span>
                                                </a>
                                            @endif
                                            <a href="#" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                                <span class="mr-1">✏️</span>
                                                <span>Modifier</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($users->count() === 0)
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">👥</span>
                        </div>
                        <p class="text-gray-500 text-lg">Aucun utilisateur trouvé</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
