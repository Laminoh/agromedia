<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Modération des commentaires
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">💬 Modération des commentaires</h1>
                    <p class="text-gray-500 mt-1">Gérez les commentaires et avis des utilisateurs</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                    <span>←</span>
                    <span class="ml-1">Retour au dashboard</span>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                @php
                    $allComments = \App\Models\Comment::all();
                    $pendingComments = $allComments->where('is_validated', false);
                    $validatedComments = $allComments->where('is_validated', true);
                @endphp
                <div class="bg-white rounded-xl p-4 border-l-4 border-blue-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total commentaires</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $allComments->count() }}</p>
                        </div>
                        <span class="text-3xl">💬</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border-l-4 border-yellow-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">En attente</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $pendingComments->count() }}</p>
                        </div>
                        <span class="text-3xl">⏳</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border-l-4 border-green-500 shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Validés</p>
                            <p class="text-2xl font-bold text-green-600">{{ $validatedComments->count() }}</p>
                        </div>
                        <span class="text-3xl">✓</span>
                    </div>
                </div>
            </div>

            <!-- Commentaires en attente -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-2">⏳</span>
                        Commentaires en attente de validation
                    </h2>
                    <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full font-medium">{{ $pendingComments->count() }}</span>
                </div>

                @if($pendingComments->count() > 0)
                    <div class="space-y-4">
                        @foreach($pendingComments as $comment)
                            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $comment->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $comment->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-yellow-500 text-lg">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $comment->rating)★@else☆@endif
                                            @endfor
                                        </span>
                                        <p class="text-sm text-gray-400 mt-1">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                                    <p class="text-sm text-gray-500 mb-1">Produit: {{ $comment->product->title }}</p>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>

                                <div class="flex gap-3">
                                    <form method="POST" action="{{ route('admin.comments.validate', $comment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2">
                                            <span>✓</span>
                                            <span>Valider</span>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex-1 bg-red-100 text-red-600 py-3 rounded-xl hover:bg-red-200 transition-colors font-medium flex items-center justify-center space-x-2">
                                            <span>🗑️</span>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
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
                        <p class="text-gray-500">Aucun commentaire en attente de validation</p>
                    </div>
                @endif
            </div>

            <!-- Commentaires validés -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2">✓</span>
                        Commentaires validés
                    </h2>
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">{{ $validatedComments->count() }}</span>
                </div>

                @if($validatedComments->count() > 0)
                    <div class="space-y-4">
                        @foreach($validatedComments as $comment)
                            <div class="bg-white rounded-2xl shadow-lg p-6 opacity-75 hover:opacity-100 transition-opacity">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $comment->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $comment->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-yellow-500 text-lg">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $comment->rating)★@else☆@endif
                                            @endfor
                                        </span>
                                        <p class="text-sm text-gray-400 mt-1">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                                    <p class="text-sm text-gray-500 mb-1">Produit: {{ $comment->product->title }}</p>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium">✓ Validé</span>
                                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium flex items-center space-x-1">
                                            <span>🗑️</span>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">💬</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun commentaire validé</h3>
                        <p class="text-gray-500">Les commentaires validés apparaîtront ici</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
