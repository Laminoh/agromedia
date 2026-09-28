<x-producer-layout title="Modifier le produit">
    <!-- Page Title -->
    <div class="mb-4 sm:mb-6">
        <a href="{{ route('producer.products.show', $product) }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm sm:text-base">
            <span>←</span>
            <span class="ml-1">Retour au produit</span>
        </a>
    </div>

    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">✏️ Modifier le produit</h1>
    <p class="text-gray-500 mb-6 sm:mb-8 text-sm sm:text-base">Mettez à jour les informations de votre produit</p>

    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
        <form method="POST" action="{{ route('producer.products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="p-4 sm:p-6 md:p-8">
                <!-- Informations de base -->
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 mb-3 sm:mb-4 flex items-center">
                        <span class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2 text-xs sm:text-sm">1</span>
                        Informations de base
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Titre -->
                        <div class="md:col-span-2">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700">Titre du produit *</label>
                                <x-audio-button buttonName="product_title" text="🔊" />
                            </div>
                            <input type="text" name="title" required 
                                   class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm sm:text-base"
                                   placeholder="Ex: Tomates fraîches de saison"
                                   value="{{ old('title', $product->title) }}">
                            @error('title')
                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700">Catégorie</label>
                                <x-audio-button buttonName="product_category" text="🔊" />
                            </div>
                            <select name="category" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm sm:text-base">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="légumes" {{ old('category', $product->category) === 'légumes' ? 'selected' : '' }}>🥬 Légumes</option>
                                <option value="fruits" {{ old('category', $product->category) === 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                <option value="céréales" {{ old('category', $product->category) === 'céréales' ? 'selected' : '' }}>🌾 Céréales</option>
                                <option value="viandes" {{ old('category', $product->category) === 'viandes' ? 'selected' : '' }}>🥩 Viandes</option>
                                <option value="poissons" {{ old('category', $product->category) === 'poissons' ? 'selected' : '' }}>🐟 Poissons</option>
                                <option value="produits laitiers" {{ old('category', $product->category) === 'produits laitiers' ? 'selected' : '' }}>🥛 Produits laitiers</option>
                                <option value="autres" {{ old('category', $product->category) === 'autres' ? 'selected' : '' }}>📦 Autres</option>
                            </select>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Prix (FCFA)</label>
                            <div class="relative">
                                <input type="number" name="price" step="0.01" min="0"
                                       class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm sm:text-base"
                                       placeholder="0"
                                       value="{{ old('price', $product->price) }}">
                                <span class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs sm:text-sm">FCFA</span>
                            </div>
                        </div>

                        <!-- Localisation -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Localisation</label>
                            <input type="text" name="location" 
                                   class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm sm:text-base"
                                   placeholder="Ex: Dakar, Thiès, Saint-Louis..."
                                   value="{{ old('location', $product->location) }}">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4" 
                                      class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all resize-none text-sm sm:text-base"
                                      placeholder="Décrivez votre produit (origine, qualité, quantité disponible...)">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Médias -->
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 mb-3 sm:mb-4 flex items-center">
                        <span class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-2 text-xs sm:text-sm">2</span>
                        Médias (Images & Vidéos)
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Images -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">📷 Images</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg sm:rounded-xl p-4 sm:p-6 hover:border-green-500 transition-colors cursor-pointer bg-gray-50 hover:bg-green-50">
                                <input type="file" name="images[]" multiple accept="image/*" class="w-full hidden" id="imageInput">
                                <label for="imageInput" class="cursor-pointer">
                                    <div class="text-center">
                                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3">
                                            <span class="text-2xl sm:text-3xl">📷</span>
                                        </div>
                                        <p class="text-gray-600 font-medium text-sm sm:text-base">Cliquez pour ajouter des images</p>
                                        <p class="text-gray-400 text-xs sm:text-sm mt-1">JPEG, PNG, JPG, GIF (Max 2MB)</p>
                                    </div>
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-3 sm:mt-4 grid grid-cols-3 gap-2"></div>
                        </div>

                        <!-- Vidéos -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">🎥 Vidéos</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg sm:rounded-xl p-4 sm:p-6 hover:border-blue-500 transition-colors cursor-pointer bg-gray-50 hover:bg-blue-50">
                                <input type="file" name="videos[]" multiple accept="video/*" class="w-full hidden" id="videoInput">
                                <label for="videoInput" class="cursor-pointer">
                                    <div class="text-center">
                                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3">
                                            <span class="text-2xl sm:text-3xl">🎥</span>
                                        </div>
                                        <p class="text-gray-600 font-medium text-sm sm:text-base">Cliquez pour ajouter des vidéos</p>
                                        <p class="text-gray-400 text-xs sm:text-sm mt-1">MP4, AVI, MOV (Max 10MB)</p>
                                    </div>
                                </label>
                            </div>
                            <div id="videoPreview" class="mt-3 sm:mt-4 space-y-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 sm:gap-4 pt-4 sm:pt-6 border-t border-gray-200">
                    <a href="{{ route('producer.products.show', $product) }}" class="px-4 sm:px-6 py-2.5 sm:py-3 border border-gray-300 text-gray-700 rounded-lg sm:rounded-xl hover:bg-gray-50 transition-colors font-medium text-sm sm:text-base text-center sm:text-left">
                        Annuler
                    </a>
                    <div class="flex items-center gap-2 justify-center sm:justify-end">
                        <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg sm:rounded-xl hover:shadow-lg transition-all font-medium flex items-center space-x-2 text-sm sm:text-base">
                            <span>💾</span>
                            <span>Mettre à jour</span>
                        </button>
                        <x-audio-button buttonName="save_product" text="🔊" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Image preview
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative aspect-square rounded-lg overflow-hidden';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button type="button" class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full text-xs hover:bg-red-600">×</button>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        // Video preview
        document.getElementById('videoInput').addEventListener('change', function(e) {
            const preview = document.getElementById('videoPreview');
            preview.innerHTML = '';
            
            Array.from(this.files).forEach(file => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-3 bg-gray-100 rounded-lg';
                div.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <span class="text-2xl">🎥</span>
                        <span class="text-sm text-gray-700 truncate max-w-xs">${file.name}</span>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-600">×</button>
                `;
                preview.appendChild(div);
            });
        });
    </script>
</x-producer-layout>
