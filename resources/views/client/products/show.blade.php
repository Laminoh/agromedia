<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Détails du produit
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <!-- Header -->
            <div class="mb-4 sm:mb-8">
                <a href="{{ route('client.products.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm sm:text-base">
                    <span>←</span>
                    <span class="ml-1">Retour au catalogue</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8">
                <!-- Médias Gallery -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
                    @if($product->media->where('type', 'image')->count() > 0)
                        <div class="relative">
                            <!-- Main Image -->
                            <div class="aspect-video bg-gray-100">
                                <img src="{{ $product->media->where('type', 'image')->first()->url }}"
                                     alt="{{ $product->title }}" 
                                     id="mainImage"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        <!-- Thumbnails -->
                        @if($product->media->where('type', 'image')->count() > 1)
                        <div class="p-3 sm:p-4 border-t border-gray-100">
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($product->media->where('type', 'image') as $index => $image)
                                <div class="aspect-square rounded-lg overflow-hidden cursor-pointer border-2 {{ $index === 0 ? 'border-green-500' : 'border-transparent' }} hover:border-green-500 transition-colors"
                                     onclick="changeMainImage('{{ $image->url }}', this)">
                                    <img src="{{ $image->url }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
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

                    <!-- Videos -->
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
                                    <source src="{{ $video->url }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Informations -->
                <div class="space-y-4 sm:space-y-6">
                    <!-- Status Badge -->
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
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

                    @if($product->description)
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
                        <h3 class="font-bold text-gray-800 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                            <span class="w-6 h-6 bg-gray-100 text-gray-600 rounded flex items-center justify-center mr-2 text-xs sm:text-sm">📝</span>
                            Description
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ $product->description }}</p>
                    </div>
                    @endif

                    <!-- Producteur Info -->
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6">
                        <h3 class="font-bold text-gray-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded flex items-center justify-center mr-2 text-xs sm:text-sm">👨‍🌾</span>
                            Informations du producteur
                        </h3>
                        <div class="flex items-center gap-3 sm:gap-4 mb-3 sm:mb-4">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white text-lg sm:text-2xl font-bold">
                                {{ substr($product->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm sm:text-base">{{ $product->user->name }}</h4>
                                @if($product->user->location)
                                    <p class="text-gray-500 text-xs sm:text-sm">📍 {{ $product->user->location }}</p>
                                @endif
                            </div>
                        </div>

                        @if($product->user->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->whatsapp_number) }}?text=Bonjour, je suis intéressé par votre produit: {{ $product->title }}" 
                               target="_blank"
                               class="block w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white text-center py-3 sm:py-4 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2 text-sm sm:text-base">
                                <span class="text-xl sm:text-2xl">📱</span>
                                <span>Contacter via WhatsApp</span>
                            </a>
                        @else
                            <p class="text-gray-500 text-xs sm:text-sm text-center py-3 sm:py-4">Le producteur n'a pas renseigné son numéro WhatsApp</p>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        @if($product->user->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->whatsapp_number) }}?text=Bonjour, je souhaite commander: {{ $product->title }}" 
                               target="_blank"
                               class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-center py-3 sm:py-4 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium flex items-center justify-center space-x-2 text-sm sm:text-base">
                                <span>🛒</span>
                                <span>Commander</span>
                            </a>
                        @endif
                        <div class="flex items-center gap-2 justify-center sm:justify-start">
                            <x-audio-button buttonName="order_product" text="🔊" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commentaires -->
            <div class="mt-6 sm:mt-8 bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-100">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-6 h-6 sm:w-8 sm:h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-2 text-xs sm:text-sm">💬</span>
                        Commentaires et avis ({{ $product->comments->where('is_validated', true)->count() }})
                    </h3>
                </div>
                
                @if($product->comments->where('is_validated', true)->count() > 0)
                    <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                        @foreach($product->comments->where('is_validated', true) as $comment)
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
                @else
                    <div class="p-4 sm:p-6 text-center text-gray-500">
                        <p class="text-sm sm:text-base">Aucun commentaire pour le moment. Soyez le premier à donner votre avis !</p>
                    </div>
                @endif

                <!-- Formulaire de commentaire -->
                @if(auth()->check())
                    <div class="p-4 sm:p-6 border-t border-gray-100 bg-gray-50">
                        <h4 class="font-bold text-gray-800 mb-3 sm:mb-4 text-sm sm:text-base">Laisser un commentaire</h4>
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 mb-3 sm:mb-4">
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Votre note</label>
                                    <select name="rating" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm sm:text-base">
                                        <option value="5">⭐⭐⭐⭐⭐ (5 - Excellent)</option>
                                        <option value="4">⭐⭐⭐⭐ (4 - Très bien)</option>
                                        <option value="3">⭐⭐⭐ (3 - Bien)</option>
                                        <option value="2">⭐⭐ (2 - Moyen)</option>
                                        <option value="1">⭐ (1 - Médiocre)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 sm:mb-4">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Votre commentaire</label>
                                <textarea name="content" rows="3" required 
                                          class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all resize-none text-sm sm:text-base"
                                          placeholder="Partagez votre expérience avec ce produit..."></textarea>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium flex items-center space-x-2 text-sm sm:text-base">
                                <span>💬</span>
                                <span>Publier mon commentaire</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="p-4 sm:p-6 border-t border-gray-100 text-center">
                        <p class="text-gray-500 mb-3 sm:mb-4 text-sm sm:text-base">
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">Connectez-vous</a> pour laisser un commentaire.
                        </p>
                        <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium text-sm sm:text-base">
                            <span>🔑</span>
                            <span>Se connecter</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
</x-app-layout>
