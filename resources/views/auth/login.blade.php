<x-guest-layout>
<!-- Session Status -->
@if (session('status'))
    <div class="success-message">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="form-group">
        <label class="form-label">Email</label>
        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
               class="form-input"
               placeholder="votre@email.com">
        @error('email')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-group">
        <label class="form-label">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="current-password"
               class="form-input"
               placeholder="••••••••">
        @error('password')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="form-actions">
        <label class="form-checkbox">
            <input type="checkbox" name="remember">
            <span>Se souvenir de moi</span>
        </label>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-link">
                Mot de passe oublié ?
            </a>
        @endif
    </div>

    <button type="submit" class="btn-submit">
        <span>🔑</span>
        <span>Se connecter</span>
    </button>

    <div class="register-link">
        <p>
            Pas encore inscrit ?
            <a href="{{ route('register') }}">Créer un compte</a>
        </p>
    </div>
</form>
</x-guest-layout>
