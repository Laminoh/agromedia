<x-guest-layout>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="form-group">
        <label class="form-label">Nom complet</label>
        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
               class="form-input"
               placeholder="Votre nom">
        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="form-group">
        <label class="form-label">Email</label>
        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
               class="form-input"
               placeholder="votre@email.com">
        @error('email')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <div class="form-group">
        <label class="form-label">Je suis</label>
        <select id="role" name="role" class="form-input" required>
            <option value="">Sélectionner votre rôle</option>
            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>🛒 Client (Acheteur)</option>
            <option value="producteur" {{ old('role') == 'producteur' ? 'selected' : '' }}>👨‍🌾 Producteur (Vendeur)</option>
        </select>
        @error('role')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Phone -->
    <div class="form-group">
        <label class="form-label">Téléphone</label>
        <input id="phone" type="text" name="phone" :value="old('phone')" autocomplete="tel"
               class="form-input"
               placeholder="+221 77 000 00 00">
        @error('phone')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Location -->
    <div class="form-group">
        <label class="form-label">Localisation</label>
        <input id="location" type="text" name="location" :value="old('location')" autocomplete="address-level2"
               class="form-input"
               placeholder="Dakar, Thiès, Saint-Louis...">
        @error('location')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- WhatsApp Number -->
    <div class="form-group">
        <label class="form-label">Numéro WhatsApp</label>
        <input id="whatsapp_number" type="text" name="whatsapp_number" :value="old('whatsapp_number')" autocomplete="tel"
               class="form-input"
               placeholder="+221 77 000 00 00">
        @error('whatsapp_number')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-group">
        <label class="form-label">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="new-password"
               class="form-input"
               placeholder="••••••••">
        @error('password')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label class="form-label">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
               class="form-input"
               placeholder="••••••••">
        @error('password_confirmation')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-submit">
        <span>🚀</span>
        <span>Créer mon compte</span>
    </button>

    <div class="register-link">
        <p>
            Déjà inscrit ?
            <a href="{{ route('login') }}">Se connecter</a>
        </p>
    </div>
</form>
</x-guest-layout>
