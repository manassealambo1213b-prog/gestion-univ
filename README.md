# Gestion Univ - TFC UNIKIN

Système de gestion universitaire développé en **Laravel 10** pour la gestion des étudiants, filières, paiements et génération de documents PDF.

> **Auteur:** MANASSE ALAMBO- UWB
> **Repo:** https://github.com/manassealambo1213b-prog/gestion-univ

### Fonctionnalités
- Gestion des étudiants (CRUD)
- Gestion des filières
- Gestion des paiements (motif, montant, référence)
- Génération PDF :
    - `fiche.blade.php` : Fiche individuelle avec TOTAL
    - `liste.blade.php` : Liste globale
- Dashboard

### Stack Technique
- Laravel 10
- Blade
- barryvdh/laravel-dompdf
- MySQL

### Installation
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve