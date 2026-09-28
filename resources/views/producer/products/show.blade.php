<x-producer-layout title="Détails du produit">
    <!-- Page Title -->
    <div class="mb-4 sm:mb-6">
        <a href="{{ route('producer.products.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm sm:text-base">
            <span>←</span>
            <span class="ml-1">Retour à mes produits</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] gap-4 sm:gap-6 lg:gap-8">
        <!-- Contenu principal à gauche -->
        <div class="space-y-4 sm:space-y-6">
            <div class="bg-green-50 rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
                @if($product->media->where('type', 'image')->count() > 0)
                    <div class="relative">
                        <!-- Main Image -->
                        <div class="aspect-video bg-gray-100">
                            <img src="{{ asset('storage/' . $product->media->where('type', 'image')->first()->path) }}"
                                 alt="{{ $product->title }}"
                                 id="mainImage"
                                 class="w-full h-full object-cover max-h-96">
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    @if($product->media->where('type', 'image')->count() > 1)
                    <div class="p-3 sm:p-4 border-t border-gray-100">
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($product->media->where('type', 'image') as $index => $image)
                            <div class="aspect-square rounded-lg overflow-hidden cursor-pointer border-2 {{ $index === 0 ? 'border-green-500' : 'border-transparent' }} hover:border-green-500 transition-colors"
                                 onclick="changeMainImage('{{ asset('storage/' . $image->path) }}', this)">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @else
                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <span class="text-4xl sm:text-6xl">🌾</span>
                    </div>
                @endif

                @if($product->media->where('type', 'video')->count() > 0)
                <div class="p-3 sm:p-4 border-t border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded flex items-center justify-center mr-2 text-xs sm:text-sm">🎥</span>
                        Vidéos ({{ $product->media->where('type', 'video')->count() }})
                    </h3>
                    <div class="space-y-2 sm:space-y-3">
                        @foreach($product->media->where('type', 'video') as $video)
                        <div class="bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden">
                            <video controls class="w-full">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la vidéo.
                            </video>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            @if($product->description)
            <div class="bg-green-50 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
                <h3 class="font-bold text-gray-800 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                    <span class="w-6 h-6 bg-gray-100 text-gray-600 rounded flex items-center justify-center mr-2 text-xs sm:text-sm">📝</span>
                    Description
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ $product->description }}</p>
            </div>
            @endif
        </div>

        <!-- Barre d'actions à droite -->
        <div class="space-y-4 sm:space-y-6">
            <div class="sticky top-6 bg-green-50 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3 sm:mb-4">
                    @if($product->is_validated)
                        <span class="bg-green-100 text-green-800 text-xs sm:text-sm px-3 sm:px-4 py-1.5 sm:py-2 rounded-full font-medium flex items-center w-fit">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            ✓ Validé
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-xs sm:text-sm px-3 sm:px-4 py-1.5 sm:py-2 rounded-full font-medium flex items-center w-fit">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                            ⏳ En attente de validation
                        </span>
                    @endif
                    <span class="text-gray-400 text-xs sm:text-sm">{{ $product->created_at->format('d/m/Y') }}</span>
                </div>

                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">{{ $product->title }}</h1>

                <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-green-600 mb-4 sm:mb-6">
                    {{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix non défini' }}
                </div>

                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg sm:rounded-xl">
                        <span class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2 sm:mr-3 text-sm sm:text-base">📦</span>
                        <div>
                            <span class="text-xs sm:text-sm text-gray-500">Catégorie</span>
                            <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ $product->category ?? 'Non catégorisé' }}</p>
                        </div>
                    </div>

                    @if($product->location)
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg sm:rounded-xl">
                        <span class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-2 sm:mr-3 text-sm sm:text-base">📍</span>
                        <div>
                            <span class="text-xs sm:text-sm text-gray-500">Localisation</span>
                            <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ $product->location }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center p-3 bg-gray-50 rounded-lg sm:rounded-xl">
                        <span class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-2 sm:mr-3 text-sm sm:text-base">📷</span>
                        <div>
                            <span class="text-xs sm:text-sm text-gray-500">Médias</span>
                            <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ $product->media->where('type', 'image')->count() }} image(s), {{ $product->media->where('type', 'video')->count() }} vidéo(s)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-sm sm:text-base">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('producer.products.edit', $product) }}" class="block w-full bg-gradient-to-r from-green-500 to-emerald-600 text-green-800 text-center py-3 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium text-sm sm:text-base">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('producer.products.destroy', $product) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 text-red-900 py-3 rounded-lg sm:rounded-xl hover:bg-red-600 transition-all font-medium text-sm sm:text-base">
                            🗑️ Supprimer
                        </button>
                    </form>
                    <a href="{{ route('producer.products.index') }}" class="block w-full border border-gray-200 text-gray-700 py-3 rounded-lg sm:rounded-xl hover:bg-gray-50 transition-all font-medium text-sm sm:text-base text-center">
                        ← Retour à mes produits
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Commentaires -->
    @if($product->comments->count() > 0)
    <div class="mt-6 sm:mt-8 bg-green-50 rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-100">
            <h3 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center">
                <span class="w-6 h-6 sm:w-8 sm:h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-2 text-xs sm:text-sm">💬</span>
                Commentaires ({{ $product->comments->count() }})
            </h3>
        </div>
        <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
            @foreach($product->comments as $comment)
            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 sm:gap-2 mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                            {{ substr($comment->user->name, 0, 1) }}
                        </div>
                        <div>
                            <span class="font-semibold text-gray-800 text-sm sm:text-base">{{ $comment->user->name }}</span>
                            <span class="text-gray-400 text-xs sm:text-sm ml-2">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <span class="text-yellow-500 text-base sm:text-lg">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $comment->rating)★@else☆@endif
                        @endfor
                    </span>
                </div>
                <p class="text-gray-600 text-sm sm:text-base">{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainImage').src = src;

            // Update border
            document.querySelectorAll('.aspect-square').forEach(el => {
                el.classList.remove('border-green-500');
                el.classList.add('border-transparent');
            });
            element.classList.remove('border-transparent');
            element.classList.add('border-green-500');
        }
    </script>
</x-producer-layout>
