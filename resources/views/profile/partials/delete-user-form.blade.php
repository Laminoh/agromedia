<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <span class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-2">🗑️</span>
            Supprimer le compte
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-all font-medium flex items-center space-x-2"
    >
        <span>🗑️</span>
        <span>Supprimer mon compte</span>
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
            </p>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"
                    placeholder="Votre mot de passe"
                />
                @error('userDeletion.password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                    Annuler
                </button>

                <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-all font-medium flex items-center space-x-2">
                    <span>🗑️</span>
                    <span>Supprimer le compte</span>
                </button>
            </div>
        </form>
    </x-modal>
</section>
