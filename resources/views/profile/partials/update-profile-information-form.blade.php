<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <span class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-2">👤</span>
            Informations du profil
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Mettez à jour vos informations personnelles et votre adresse email
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
            <input id="name" name="name" type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" name="email" type="email" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" :value="old('email', $user->email)" required autocomplete="username" />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                    <p class="text-sm text-yellow-800">
                        ⚠️ Votre adresse email n'est pas vérifiée.
                        <button form="send-verification" class="underline text-yellow-800 hover:text-yellow-900 font-medium">
                            Renvoyer l'email de vérification
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600 font-medium">
                            ✓ Un nouveau lien de vérification a été envoyé
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium btn-hover flex items-center space-x-2">
                <span>💾</span>
                <span>Enregistrer</span>
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 font-medium">✓ Informations enregistrées</p>
            @endif
        </div>
    </form>
</section>
