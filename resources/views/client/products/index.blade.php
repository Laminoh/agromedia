<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-green-600">Agromedia Market</p>
                <h2 class="text-xl font-semibold leading-tight text-gray-900">Produits agricoles</h2>
            </div>
            <span class="hidden rounded-full bg-green-50 px-3 py-1.5 text-sm font-semibold text-green-700 sm:inline-flex">
                {{ $products->count() }} résultats
            </span>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-5rem)] bg-[#f6f8f3] py-6 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section class="relative mb-8 overflow-hidden rounded-[2rem] bg-[#173f2a] px-6 py-8 text-white shadow-xl sm:px-10 sm:py-10">
                <div class="absolute inset-y-0 right-0 hidden w-1/2 bg-[url('/images/IM3.jpg')] bg-cover bg-center opacity-25 lg:block"></div>
                <div class="relative max-w-2xl">
                    <p class="mb-3 text-sm font-semibold uppercase tracking-[0.22em] text-lime-300">Du producteur à votre panier</p>
                    <h1 class="max-w-xl text-3xl font-bold tracking-tight sm:text-5xl">Trouvez les bons produits, au bon endroit.</h1>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-green-100 sm:text-base">Explorez une sélection de produits frais proposés par les producteurs de votre région.</p>
                    <form method="GET" action="{{ route('client.products.index') }}" class="mt-7 flex flex-col gap-2 rounded-2xl bg-white p-2 shadow-2xl sm:flex-row">
                        <label class="flex min-w-0 flex-1 items-center gap-3 px-3">
                            <span class="text-lg text-green-700">⌕</span>
                            <span class="sr-only">Rechercher un produit</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un produit..." class="w-full border-0 bg-transparent py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0">
                        </label>
                        <button type="submit" class="rounded-xl bg-[#d5ef45] px-5 py-3 text-sm font-bold text-[#173f2a] transition hover:bg-lime-300">Rechercher</button>
                    </form>
                </div>
            </section>

            <nav class="mb-8 flex gap-2 overflow-x-auto pb-1" aria-label="Catégories de produits">
                <a href="{{ route('client.products.index') }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold {{ !request('category') ? 'bg-[#173f2a] text-white' : 'bg-white text-gray-600 hover:bg-green-50' }}">Tous les produits</a>
                @foreach(['légumes' => 'Légumes', 'fruits' => 'Fruits', 'céréales' => 'Céréales', 'viandes' => 'Viandes', 'poissons' => 'Poissons', 'produits laitiers' => 'Produits laitiers'] as $value => $label)
                    <a href="{{ route('client.products.index', ['category' => $value]) }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold {{ request('category') === $value ? 'bg-[#173f2a] text-white' : 'bg-white text-gray-600 hover:bg-green-50' }}">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="grid gap-8 lg:grid-cols-[220px_1fr]">
                <aside>
                    <form method="GET" action="{{ route('client.products.index') }}" class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                        <div class="mb-5 flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Affiner</h3>
                            <x-audio-button buttonName="search_products" text="🔊" />
                        </div>
                        <div class="space-y-5">
                            <div>
                                <label for="category" class="mb-2 block text-xs font-bold uppercase tracking-wider text-gray-500">Catégorie</label>
                                <select id="category" name="category" class="w-full rounded-xl border-gray-200 text-sm focus:border-green-600 focus:ring-green-600">
                                    <option value="">Toutes</option>
                                    @foreach(['légumes', 'fruits', 'céréales', 'viandes', 'poissons', 'produits laitiers', 'autres'] as $category)
                                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="location" class="mb-2 block text-xs font-bold uppercase tracking-wider text-gray-500">Localisation</label>
                                <input id="location" type="text" name="location" value="{{ request('location') }}" placeholder="Ex. Dakar" class="w-full rounded-xl border-gray-200 text-sm focus:border-green-600 focus:ring-green-600">
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-[#173f2a] px-4 py-3 text-sm font-bold text-white transition hover:bg-green-800">Appliquer les filtres</button>
                            @if(request('search') || request('category') || request('location'))
                                <a href="{{ route('client.products.index') }}" class="block text-center text-xs font-semibold text-red-600 hover:text-red-700">Réinitialiser les filtres</a>
                            @endif
                        </div>
                    </form>
                </aside>

                <section>
                    <div class="mb-5 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Catalogue disponible</p>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $products->count() }} produit(s) trouvé(s)</h2>
                        </div>
                        @if(request('search') || request('category') || request('location'))
                            <div class="hidden text-right text-xs text-gray-500 sm:block">Résultats filtrés</div>
                        @endif
                    </div>

                    @if($products->count() > 0)
                        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach($products as $product)
                                @php($image = $product->media->where('type', 'image')->first())
                                <article class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                                    <a href="{{ route('client.products.show', $product) }}" class="relative block aspect-[4/3] overflow-hidden bg-green-50">
                                        <img src="{{ $image ? asset('storage/' . $image->path) : asset('images/IM5.jpg') }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-green-800">{{ ucfirst($product->category ?? 'Produit') }}</span>
                                    </a>
                                    <div class="p-5">
                                        <div class="flex items-start justify-between gap-3">
                                            <h3 class="line-clamp-2 font-bold text-gray-900">{{ $product->title }}</h3>
                                            @if($product->is_validated)<span class="text-green-600" title="Produit validé">✓</span>@endif
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">{{ $product->location ?: 'Localisation non renseignée' }}</p>
                                        <div class="mt-5 flex items-center justify-between gap-3">
                                            <p class="text-lg font-extrabold text-green-700">{{ $product->price ? number_format($product->price, 0, ',', ' ') . ' FCFA' : 'Prix à définir' }}</p>
                                            <a href="{{ route('client.products.show', $product) }}" class="rounded-lg border border-green-700 px-3 py-2 text-xs font-bold text-green-800 transition hover:bg-green-50">Voir</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
                            <p class="text-4xl">⌕</p>
                            <h3 class="mt-4 text-xl font-bold text-gray-900">Aucun produit trouvé</h3>
                            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">Modifiez votre recherche ou vos filtres pour découvrir d'autres produits.</p>
                            <a href="{{ route('client.products.index') }}" class="mt-6 inline-flex rounded-xl bg-[#173f2a] px-5 py-3 text-sm font-bold text-white">Voir tout le catalogue</a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
