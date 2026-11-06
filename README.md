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

- **Backend**: Laravel 12 (PHP Framework)
- **Frontend**: Blade Templates, HTML, CSS, JavaScript
- **Base de données**: SQLite (développement) / MySQL (production)
- **Authentification**: Laravel Breeze
- **Design**: TailwindCSS avec thème vert-blanc

## 📦 Installation

### Prérequis
- PHP 8.2+
- Composer
- Node.js et npm
- MySQL si vous ne souhaitez pas utiliser SQLite

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

4. Configurer les identifiants de l'administrateur dans `.env` (`ADMIN_EMAIL` et `ADMIN_PASSWORD`) avec un mot de passe unique d'au moins 12 caractères. Ne partagez pas et ne committez jamais ces valeurs.

5. Exécuter les migrations
```bash
php artisan migrate
php artisan db:seed --class=AdminSeeder
```

6. Lier le stockage
```bash
php artisan storage:link
```

7. Compiler les assets
```bash
npm run build
```

8. Démarrer le serveur
```bash
php artisan serve
```

Le seeder d'administration refuse de créer un compte si `ADMIN_EMAIL` ou `ADMIN_PASSWORD` n'est pas configuré.

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
- Définir les variables d'environnement sur le serveur : `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, une `APP_KEY` générée et les paramètres de la base de données.
- Configurer `ADMIN_EMAIL` et `ADMIN_PASSWORD` avec des identifiants uniques et un mot de passe d'au moins 12 caractères. Ne jamais utiliser un mot de passe de développement en production.
- Installer les dépendances PHP sans les outils de développement : `composer install --no-dev --optimize-autoloader`.
- Installer et compiler les assets : `npm ci` puis `npm run build`.
- Exécuter les migrations avec `php artisan migrate --force`.
- Créer le lien de stockage avec `php artisan storage:link` si le stockage local est utilisé.
- Configurer la racine web du serveur pour qu'elle pointe vers le dossier `public/`.

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

Développé avec Laravel 12 et TailwindCSS.
