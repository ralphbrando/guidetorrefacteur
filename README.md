# Guide 2026 des Torréfacteurs

Site web pour la gestion du Guide 2026 des Torréfacteurs - « La Brulerie près de chez moi »

## Installation

### Prérequis
- PHP >= 8.0
- Composer
- MySQL/MariaDB
- Node.js et NPM (pour les assets)

### Étapes d'installation

1. **Cloner le projet et installer les dépendances**

```bash
cd c:\laragon\www\guidedestorrefacteurs
composer install
npm install
```

2. **Configuration de l'environnement**

Copiez le fichier `.env.example` vers `.env` :
```bash
copy .env.example .env
```

Éditez le fichier `.env` et configurez :
- `DB_DATABASE=guide_torrefacteurs`
- `DB_USERNAME=root`
- `DB_PASSWORD=` (vide par défaut sur Laragon)
- `APP_URL=http://guidedestorrefacteurs.test` (ou votre URL locale)
- `STRIPE_KEY=` (clé publique Stripe)
- `STRIPE_SECRET=` (clé secrète Stripe)
- `PAYPAL_CLIENT_ID=` (ID client PayPal)
- `PAYPAL_CLIENT_SECRET=` (Secret PayPal)

3. **Générer la clé d'application**

```bash
php artisan key:generate
```

4. **Créer la base de données**

Créez la base de données `guide_torrefacteurs` dans MySQL.

5. **Exécuter les migrations et seeders**

```bash
php artisan migrate
php artisan db:seed
```

6. **Créer le lien symbolique pour le stockage**

```bash
php artisan storage:link
```

7. **Compiler les assets**

```bash
npm run dev
# ou pour la production
npm run build
```

8. **Installer Laravel Nova**

Suivez les instructions d'installation de Laravel Nova :
- Téléchargez Nova depuis https://nova.laravel.com
- Placez-le dans le dossier `nova` à la racine du projet
- Exécutez `composer update`

## Utilisateurs par défaut

Après avoir exécuté les seeders, vous pouvez vous connecter avec :

- **Admin** : admin@guide-torrefacteurs.fr / password
- **Commercial 1** : commercial1@guide-torrefacteurs.fr / password
- **Commercial 2** : commercial2@guide-torrefacteurs.fr / password

## Structure du projet

- **Frontend** : Pages publiques et formulaire pour les torréfacteurs
- **Backend (Nova)** : Administration complète accessible via `/nova`
- **API** : Routes API pour les fonctionnalités dynamiques

## Fonctionnalités principales

### Pour les Torréfacteurs
- Inscription et connexion
- Formulaire de saisie des informations
- Choix d'une offre partenaire
- Paiement en ligne (Stripe, PayPal, virement)
- Prévisualisation de leur fiche

### Pour les Administrateurs (Nova)
- Gestion des utilisateurs
- Gestion des torréfacteurs
- Gestion des régions et départements
- Gestion des équipements et icônes
- Gestion des offres partenaires
- Gestion des paiements
- Ajout de champs supplémentaires
- Envoi d'emails de rappel
- Génération de PDF pour impression

## Génération du PDF

Le guide peut être généré en plusieurs formats :
- **Prévisualisation** : `/pdf/preview` - Vue d'ensemble
- **PDF standard** : `/pdf/generate?type=preview` - Pour consultation
- **PDF impression** : `/pdf/generate?type=print` - Haute résolution pour impression
- **PDF Illustrator** : `/pdf/illustrator` - Format modifiable sous Illustrator

## Configuration des paiements

### Stripe
1. Créez un compte sur https://stripe.com
2. Récupérez vos clés API
3. Ajoutez-les dans le fichier `.env`

### PayPal
1. Créez un compte développeur sur https://developer.paypal.com
2. Créez une application
3. Récupérez les identifiants
4. Ajoutez-les dans le fichier `.env`

## Notes importantes

- La date limite de saisie est le **21 Décembre 2025**
- Les offres avec limite sont servies selon le principe "premier arrivé, premier servi"
- Le format du guide est A5, 2 torréfacteurs par page
- Prix public du guide : 19,99 €
- Tirage : 3.000 exemplaires

## Support

Pour toute question ou problème, contactez l'administrateur.


