# Guide d'installation - Guide 2026 des Torréfacteurs

## Étapes d'installation complètes

### 1. Prérequis
- Laragon installé et fonctionnel
- PHP >= 8.0
- Composer
- Node.js et NPM

### 2. Configuration de la base de données

1. Ouvrez Laragon
2. Créez une nouvelle base de données MySQL nommée `guide_torrefacteurs`
3. Notez vos identifiants (généralement `root` / mot de passe vide)

### 3. Installation des dépendances

```bash
cd c:\laragon\www\guidedestorrefacteurs

# Installer les dépendances PHP (si SSL pose problème, configurez composer)
composer install

# Installer les dépendances Node.js
npm install
```

**Note sur les problèmes SSL avec Composer :**
Si vous rencontrez des erreurs SSL, vous pouvez :
- Configurer les certificats SSL dans `php.ini`
- Ou utiliser `composer install --no-secure-http` (non recommandé en production)

### 4. Configuration de l'environnement

1. Copiez `.env.example` vers `.env`
2. Éditez `.env` et configurez :
   ```env
   DB_DATABASE=guide_torrefacteurs
   DB_USERNAME=root
   DB_PASSWORD=
   APP_URL=http://guidedestorrefacteurs.test
   ```

3. Générez la clé d'application :
   ```bash
   php artisan key:generate
   ```

### 5. Base de données

```bash
# Exécuter les migrations
php artisan migrate

# Remplir avec les données initiales
php artisan db:seed
```

### 6. Lien symbolique pour le stockage

```bash
php artisan storage:link
```

### 7. Compiler les assets

```bash
# Développement
npm run dev

# Production
npm run build
```

### 8. Installation de Laravel Nova

1. Téléchargez Laravel Nova depuis https://nova.laravel.com
2. Extrayez le contenu dans le dossier `nova` à la racine du projet
3. Exécutez :
   ```bash
   composer update
   ```

### 9. Configuration des paiements (optionnel pour le développement)

Pour tester les paiements, configurez dans `.env` :
```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
PAYPAL_CLIENT_ID=...
PAYPAL_CLIENT_SECRET=...
PAYPAL_MODE=sandbox
```

### 10. Accès à l'application

- **Frontend** : http://guidedestorrefacteurs.test
- **Nova Admin** : http://guidedestorrefacteurs.test/nova

### 11. Comptes par défaut

Après les seeders, vous pouvez vous connecter avec :

- **Admin** :
  - Email: admin@guide-torrefacteurs.fr
  - Password: password

- **Commercial 1** :
  - Email: commercial1@guide-torrefacteurs.fr
  - Password: password

- **Commercial 2** :
  - Email: commercial2@guide-torrefacteurs.fr
  - Password: password

## Structure des fichiers

```
guidedestorrefacteurs/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Models/               # Modèles Eloquent
│   ├── Nova/                 # Ressources Nova
│   └── ...
├── database/
│   ├── migrations/           # Migrations
│   └── seeders/              # Seeders
├── resources/
│   ├── views/                # Vues Blade
│   ├── css/                  # Styles
│   └── js/                   # JavaScript
├── routes/
│   ├── web.php               # Routes web
│   └── api.php               # Routes API
└── ...
```

## Fonctionnalités principales

### Frontend
- Page d'accueil
- Inscription / Connexion
- Formulaire de saisie des informations
- Choix d'offre partenaire
- Paiement en ligne
- Prévisualisation

### Backend (Nova)
- Gestion des utilisateurs
- Gestion des torréfacteurs
- Gestion des régions/départements
- Gestion des équipements
- Gestion des offres
- Gestion des paiements
- Génération PDF

## Commandes utiles

```bash
# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Recréer la base de données
php artisan migrate:fresh --seed

# Lancer le serveur de développement
php artisan serve
```

## Dépannage

### Erreur "Class not found"
```bash
composer dump-autoload
```

### Erreur de permissions (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### Problèmes avec les assets
```bash
npm run dev
# ou
npm run build
```

## Support

Pour toute question, consultez le README.md principal.


