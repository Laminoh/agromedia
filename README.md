# AGROMEDIA - Plateforme de valorisation multimédia des producteurs agricoles

<p align="center">
  🌱 Plateforme web pour les producteurs agricoles du Sénégal
</p>

## 📋 Description

AGROMEDIA est une plateforme web responsive qui permet aux producteurs agricoles (y compris les utilisateurs analphabètes) de promouvoir leurs produits à travers du contenu multimédia (images, vidéos, audio) et de se connecter directement avec les consommateurs.

## 🎯 Objectifs Principaux

- Donner de la visibilité aux producteurs agricoles
- Promouvoir les produits via des vidéos et images
- Permettre la communication avec les acheteurs via WhatsApp
- Rendre la plateforme accessible aux utilisateurs analphabètes via des guides audio

## 🚀 Fonctionnalités

### Pour les Producteurs
- Création et gestion de compte
- Publication de produits avec images et vidéos
- Gestion de galerie multimédia
- Réception et gestion des commandes
- Profil personnalisable avec localisation

### Pour les Clients
- Navigation et recherche de produits
- Visualisation d'images et vidéos
- Système de recherche multi-critères (nom, catégorie, localisation)
- Contact direct avec les producteurs via WhatsApp
- Système de commentaires et avis

### Pour l'Administrateur
- Gestion des utilisateurs
- Validation des produits et médias
- Modération des commentaires
- Dashboard avec statistiques
- Contrôle complet sur la plateforme

### Accessibilité Audio
- Boutons audio à côté des actions principales
- Fichiers audio pré-enregistrés par les développeurs
- Aide à la navigation pour les utilisateurs analphabètes

## 🛠️ Stack Technique

- **Backend**: Laravel 11 (PHP Framework)
- **Frontend**: Blade Templates, HTML, CSS, JavaScript
- **Base de données**: SQLite (développement) / MySQL (production)
- **Authentification**: Laravel Breeze
- **Design**: TailwindCSS avec thème vert-blanc

## 📦 Installation

### Prérequis
- PHP 8.2+
- Composer
- WAMP/XAMPP (pour MySQL en production)

### Étapes d'installation

1. Cloner le projet
```bash
git clone [repository-url]
cd agromedia
```

2. Installer les dépendances
```bash
composer install
npm install
```

3. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Exécuter les migrations
```bash
php artisan migrate
php artisan db:seed --class=AdminSeeder
```

5. Lier le stockage
```bash
php artisan storage:link
```

6. Compiler les assets
```bash
npm run build
```

7. Démarrer le serveur
```bash
php artisan serve
```

## 👤 Comptes par défaut

### Administrateur
- **Email**: admin@agromedia.sn
- **Mot de passe**: admin123

## 📁 Structure du Projet

```
agromedia/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php
│   │   │   ├── ProducerController.php
│   │   │   └── Auth/
│   │   └── Middleware/
│   │       └── CheckRole.php
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Media.php
│       ├── Audio.php
│       ├── Comment.php
│       └── Order.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── AdminSeeder.php
├── resources/
│   ├── views/
│   │   ├── producer/
│   │   ├── client/
│   │   ├── admin/
│   │   └── components/
│   │       └── audio-button.blade.php
│   └── audio/ (fichiers audio pour l'accessibilité)
└── public/
    └── storage/ (fichiers uploadés)
```

## 🔐 Sécurité

- Authentification Laravel
- Contrôle d'accès basé sur les rôles (RBAC)
- Validation des médias par l'administrateur
- Protection CSRF

## 📱 Accessibilité

- Interface iconique
- Boutons audio pour les actions principales
- Navigation simplifiée
- Focus sur le contenu visuel
- Texte minimal pour l'accessibilité

## 🌐 Déploiement

### Développement local
```bash
php artisan serve
```

### Production
- Configurer MySQL dans `.env`
- Exécuter les migrations
- Configurer le stockage (S3 ou local)
- Optimiser les assets: `npm run build --production`

## 🔧 Configuration MySQL

Pour utiliser MySQL au lieu de SQLite, modifier le fichier `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agromedia
DB_USERNAME=root
DB_PASSWORD=
```

## 📝 Notes de développement

- Le projet utilise actuellement SQLite pour le développement
- Les fichiers audio doivent être placés dans `public/audio/`
- Les images et vidéos sont stockées dans `storage/app/public/`
- Le lien symbolique `storage:link` est nécessaire pour accéder aux fichiers

## 🚧 Fonctionnalités futures

- Support multilingue (Français + langues locales)
- Version application mobile
- Intégration paiements mobiles (Wave, Orange Money)
- Système de notifications
- Chat en temps réel

## 📄 Licence

Ce projet est développé pour AGROMEDIA.

## 👥 Équipe

Développé avec Laravel 11 et TailwindCSS.
