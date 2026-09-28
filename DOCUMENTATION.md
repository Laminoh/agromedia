# AGROMEDIA - Documentation Technique Complète

## 📋 Description du Projet

**AGROMEDIA** est une plateforme web de valorisation multimédia des producteurs agricoles du Sénégal. Elle permet aux producteurs de publier leurs produits avec des images et vidéos, et aux clients de découvrir et contacter directement les producteurs via WhatsApp.

### Objectifs Principaux
- Connecter les producteurs agricoles aux clients
- Promouvoir les produits locaux avec du contenu multimédia
- Faciliter l'accès aux produits agricoles frais
- Soutenir l'agriculture locale au Sénégal

---

## 🛠️ Stack Technologique

### Backend
- **Framework**: Laravel 12.0
- **Langage**: PHP 8.2+
- **Base de données**: MySQL (via Eloquent ORM)
- **Authentification**: Laravel Breeze 2.4
- **Gestion de fichiers**: Storage Laravel

### Frontend
- **Framework CSS**: TailwindCSS 3.1.0
- **JavaScript**: Alpine.js 3.4.2
- **Build Tool**: Vite 7.0.7
- **HTTP Client**: Axios 1.11.0
- **PostCSS**: 8.4.31
- **Autoprefixer**: 10.4.2

### Outils de Développement
- **Laravel Tinker**: 2.10.1 (debugging interactif)
- **Laravel Pail**: 1.2.2 (logging)
- **Laravel Pint**: 1.24 (formatage de code)
- **Laravel Sail**: 1.41 (Docker)
- **PHPUnit**: 11.5.50 (tests)
- **Mockery**: 1.6 (mocking)
- **Faker**: 1.23 (données de test)

---

## 📁 Structure du Projet

```
agromedia/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Contrôleurs (Producer, Product, Admin, Client)
│   │   ├── Middleware/           # Middleware d'authentification
│   │   └── Requests/            # Form Requests
│   ├── Models/                  # Modèles Eloquent (User, Product, Media, Category)
│   └── Services/                # Services métier
├── config/                      # Configuration Laravel
├── database/
│   ├── migrations/              # Migrations de base de données
│   ├── seeders/                 # Seeders de données
│   └── factories/               # Factories pour tests
├── public/
│   ├── images/                  # Images statiques (logoAgro.jpeg)
│   ├── storage/                 # Fichiers uploadés (symlink)
│   └── index.php               # Point d'entrée
├── resources/
│   ├── css/                     # Styles (app.css)
│   ├── js/                      # Scripts JavaScript (app.js)
│   └── views/
│       ├── layouts/             # Layouts principaux
│       │   ├── app.blade.php    # Layout principal
│       │   ├── producer.blade.php # Layout producteur
│       │   ├── guest.blade.php  # Layout invité
│       │   └── navigation.blade.php # Navigation
│       ├── components/          # Composants Blade réutilisables
│       │   ├── producer-layout.blade.php
│       │   ├── nav-link.blade.php
│       │   └── responsive-nav-link.blade.php
│       ├── home.blade.php        # Page d'accueil
│       ├── producer/            # Vues producteurs
│       │   ├── dashboard.blade.php
│       │   └── products/
│       │       ├── index.blade.php
│       │       ├── show.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       ├── auth/                # Vues d'authentification
│       └── profile/             # Vues profil
├── routes/
│   ├── web.php                  # Routes web
│   ├── api.php                  # Routes API
│   └── console.php              # Routes console
├── storage/
│   ├── app/                     # Fichiers d'application
│   ├── framework/               # Fichiers framework (cache, logs)
│   └── logs/                   # Logs Laravel
├── tests/                       # Tests PHPUnit
├── vendor/                      # Dépendances Composer
├── node_modules/                # Dépendances NPM
├── composer.json                # Dépendances PHP
├── package.json                 # Dépendances JS
├── tailwind.config.js          # Configuration TailwindCSS
├── vite.config.js              # Configuration Vite
└── .env                        # Variables d'environnement
```

---

## 👥 Rôles Utilisateurs

### 1. **Admin**
- Accès au dashboard administrateur
- Gestion des utilisateurs
- Validation des produits
- Modération du contenu

### 2. **Producteur**
- Dashboard personnalisé avec sidebar verte
- Gestion des produits (CRUD)
- Upload d'images et vidéos
- Suivi des validations
- Profil personnalisable

### 3. **Client**
- Navigation dans le catalogue
- Recherche de produits
- Contact direct via WhatsApp
- Filtrage par catégorie, localisation, prix

---

## 🎨 Design & UI/UX

### Palette de Couleurs
- **Primaire**: Vert (#065f46, #047857, #10b981)
- **Secondaire**: Émeraude (#059669, #22c55e)
- **Accent**: Jaune (#fbbf24, #f59e0b)
- **Neutre**: Gris (#374151, #6b7280, #9ca3af)

### Composants UI
- **Sidebar Producteur**: Navigation compacte verticale (32px large)
- **Cards**: Produits avec hover effects et ombres
- **Buttons**: Gradient vert avec hover animations
- **Modals**: Confirmation de déconnexion
- **Responsive**: Mobile-first avec breakpoints sm/md/lg

### Typographie
- **Font**: Poppins (Google Fonts)
- **Poids**: 300, 400, 500, 600, 700, 800

---

## 🔌 API & Services

### Routes Principales

#### Authentification
- `GET /login` - Page de connexion
- `POST /login` - Soumission connexion
- `GET /register` - Page d'inscription
- `POST /register` - Soumission inscription
- `POST /logout` - Déconnexion

#### Producteurs
- `GET /producer/dashboard` - Dashboard producteur
- `GET /producer/products` - Liste des produits
- `GET /producer/products/create` - Formulaire création
- `POST /producer/products` - Création produit
- `GET /producer/products/{id}` - Détails produit
- `GET /producer/products/{id}/edit` - Formulaire édition
- `PUT/PATCH /producer/products/{id}` - Mise à jour produit
- `DELETE /producer/products/{id}` - Suppression produit

#### Clients
- `GET /` - Page d'accueil
- `GET /client/products` - Catalogue produits
- `GET /client/products/{id}` - Détails produit

#### Admin
- `GET /admin/dashboard` - Dashboard admin
- `GET /admin/products` - Gestion produits
- `PUT /admin/products/{id}/validate` - Validation produit

### Intégrations Externes
- **WhatsApp**: Contact direct producteurs
- **Google Fonts**: Poppins
- **Bunny.net**: Fonts CDN
- **Vite**: Asset bundling

---

## 🗄️ Base de Données

### Tables Principales
- **users**: Utilisateurs (admin, producteur, client)
- **products**: Produits agricoles
- **media**: Fichiers multimédia (images, vidéos)
- **categories**: Catégories de produits
- **regions**: Régions du Sénégal

### Relations
- User → Products (One-to-Many)
- Product → Media (One-to-Many)
- Product → Category (Many-to-One)
- User → Region (Many-to-One)

---

## 🚀 Installation & Setup

### Prérequis
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- WAMP/XAMPP (environnement Windows)

### Étapes d'Installation

1. **Cloner le projet**
```bash
git clone <repository-url>
cd agromedia
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JS**
```bash
npm install
```

4. **Configuration environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agromedia
DB_USERNAME=root
DB_PASSWORD=
```

6. **Exécuter les migrations**
```bash
php artisan migrate
```

7. **Lier le storage**
```bash
php artisan storage:link
```

8. **Compiler les assets**
```bash
npm run build
```

9. **Lancer le serveur**
```bash
php artisan serve
```

### Scripts Disponibles
```bash
composer setup          # Installation complète
composer dev            # Mode développement (serveur + queue + logs + vite)
composer test           # Exécuter les tests
npm run dev            # Vite en mode développement
npm run build          # Vite en mode production
```

---

## 🔧 Configuration

### Variables d'Environnement Clés
```env
APP_NAME=AGROMEDIA
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 📝 Fonctionnalités

### Pour les Producteurs
- ✅ Dashboard avec statistiques
- ✅ CRUD complet des produits
- ✅ Upload d'images et vidéos
- ✅ Validation des produits
- ✅ Profil personnalisable
- ✅ Gestion des médias
- ✅ Localisation des produits

### Pour les Clients
- ✅ Navigation intuitive
- ✅ Recherche multi-critères
- ✅ Filtrage par catégorie
- ✅ Contact WhatsApp direct
- ✅ Affichage des produits validés
- ✅ Interface responsive

### Pour l'Admin
- ✅ Dashboard administrateur
- ✅ Validation des produits
- ✅ Gestion des utilisateurs
- ✅ Modération du contenu

---

## 🎯 Points Forts Techniques

1. **Architecture MVC**: Séparation claire des responsabilités
2. **ORM Eloquent**: Manipulation intuitive de la BDD
3. **Blade Templates**: Templating puissant et réutilisable
4. **TailwindCSS**: Design utility-first rapide
5. **Alpine.js**: Interactivité légère sans framework lourd
6. **Vite**: Build tool ultra-rapide
7. **Laravel Breeze**: Authentification prête à l'emploi
8. **Storage Laravel**: Gestion flexible des fichiers
9. **Responsive Design**: Mobile-first approach
10. **Accessibilité**: Support pour utilisateurs analphabètes (boutons audio)

---

## 🚧 Améliorations Futures

- [ ] Intégration paiement mobile (Orange Money, Wave)
- [ ] Système de notation/avis
- [ ] Chat intégré entre producteurs et clients
- [ ] Notifications push
- [ ] Application mobile (React Native)
- [ ] Analytics avancés
- [ ] Système de recommandation IA
- [ ] Multi-langue (Wolof, Français, Anglais)

---

## 📞 Support & Contact

- **Email**: contact@agromedia.sn
- **Téléphone**: +221 77 000 00 00
- **Localisation**: Dakar, Sénégal

---

## 📄 Licence

MIT License - Tous droits réservés © 2024 AGROMEDIA

---

**Document généré le 28 septembre 2026**
**Version**: 1.0.0
