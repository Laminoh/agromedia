<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-2">🔒</span>
            Modifier le mot de passe
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" autocomplete="current-password" />
            @error('updatePassword.current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" autocomplete="new-password" />
            @error('updatePassword.password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" autocomplete="new-password" />
            @error('updatePassword.password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium btn-hover flex items-center space-x-2">
                <span>💾</span>
                <span>Enregistrer</span>
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 font-medium">✓ Mot de passe modifié</p>
            @endif
        </div>
    </form>
</section>
