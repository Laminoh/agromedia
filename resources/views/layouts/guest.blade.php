<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AGROMEDIA - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0fdfa 100%) !important;
            min-height: 100vh;
        }

        body.login-page {
            background:
                linear-gradient(rgba(15, 23, 42, 0.35), rgba(15, 23, 42, 0.35)),
                url('{{ asset('images/IM6.jpg') }}') center / cover fixed !important;
        }
        
        .nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }
        
        .nav-content {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #22c55e 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1.5rem;
        }

        .logo-icon img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #16a34a 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .nav-link {
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: #16a34a;
        }
        
        .btn-nav {
            background: linear-gradient(90deg, #22c55e 0%, #059669 100%);
            color: white;
            padding: 0.625rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-nav:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .main-content {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }
        
        .form-container {
            max-width: 448px;
            width: 100%;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .welcome-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4ade80 0%, #059669 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            font-size: 2.5rem;
            animation: floating 3s ease-in-out infinite;
        }

        .welcome-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .welcome-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            color: #6b7280;
        }
        
        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            transition: all 0.3s;
        }
        
        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-checkbox input {
            border-radius: 6px;
            border-color: #d1d5db;
        }
        
        .form-checkbox label {
            font-size: 0.875rem;
            color: #4b5563;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .forgot-link {
            color: #16a34a;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            color: #15803d;
        }
        
        .btn-submit {
            width: 100%;
            background: linear-gradient(90deg, #22c55e 0%, #059669 100%);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }
        
        .btn-submit:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
        }
        
        .register-link a {
            color: #16a34a;
            text-decoration: none;
            font-weight: 700;
        }
        
        .register-link a:hover {
            color: #15803d;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .success-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body @if (request()->routeIs('login')) class="login-page" @endif>
    <!-- Navigation -->
    <nav class="nav">
        <div class="nav-content">
            <div class="logo">
                <div class="logo-icon">
                    <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-8 h-8 object-contain">
                </div>
                <a href="/" class="logo-text">AGROMEDIA</a>
            </div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                <a href="{{ route('register') }}" class="btn-nav">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-container">
            <div class="welcome-section">
                <div class="welcome-icon">
                    <img src="{{ asset('images/logoAgro.jpeg') }}" alt="AGROMEDIA" class="w-10 h-10 object-contain">
                </div>
                <h1 class="welcome-title">Bienvenue sur AGROMEDIA</h1>
                <p class="welcome-subtitle">Plateforme des producteurs agricoles du Sénégal</p>
            </div>
            
            <div class="form-card">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
