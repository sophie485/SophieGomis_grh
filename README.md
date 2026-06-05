# GRH - Gestion des Ressources Humaines

## Description

Application de Gestion des Ressources Humaines développée avec Laravel 12.

Cette application permet de centraliser les informations des employés, gérer les départements, les congés et les contrats au sein d'une entreprise.

---

## Fonctionnalités

### Gestion des employés

* Ajouter un employé
* Modifier un employé
* Supprimer un employé
* Consulter la liste des employés
* Gestion des informations personnelles
* Gestion du solde de congés

### Informations employé

Chaque employé possède :

* Nom
* Prénom
* Email
* Téléphone
* Poste
* Département
* Date d'embauche
* Salaire
* Solde de congés

### Gestion des départements

Départements disponibles :

* Informatique
* Comptabilité
* Ressources Humaines
* Marketing

Fonctionnalités :

* Ajouter un département
* Modifier un département
* Supprimer un département
* Consulter la liste des départements

---

## Gestion des documents

* Photo de profil de l'employé
* Documents administratifs
* Diplômes
* Contrats

---

## Gestion des congés

Fonctionnalités :

* Création d'une demande de congé
* Validation d'une demande de congé
* Refus d'une demande de congé
* Suivi du statut du congé

Statuts disponibles :

* En attente
* Approuvé
* Refusé

### Calcul automatique

Lorsqu'un congé est approuvé :

* Le nombre de jours est calculé automatiquement
* Formule utilisée :

(date_fin - date_debut) + 1

* Le solde de congés de l'employé est automatiquement mis à jour

---

## Gestion des contrats

### Types de contrats

* CDI
* CDD
* Stage
* Freelance

### Fonctionnalités

* Création d'un contrat
* Modification d'un contrat
* Suppression d'un contrat
* Consultation des contrats

### Alertes

* Détection automatique des contrats proches de leur date d'expiration
* Affichage des contrats arrivant à échéance dans les 30 prochains jours

---

## Logique métier

### Solde de congés

Chaque employé dispose d'un solde de congés.

Lorsqu'un congé est approuvé :

1. Calcul du nombre de jours de congé
2. Déduction automatique du nombre de jours
3. Mise à jour du solde restant

### Contrats

* Un employé peut posséder plusieurs contrats
* Les contrats sont liés à l'employé
* Les contrats peuvent être suivis jusqu'à leur expiration

---

## Structure du projet

### Modèles

* Employe
* Departement
* Conge
* Contrat

### Contrôleurs

* EmployeController
* DepartementController
* CongeController
* ContratController

### Relations

* Un département possède plusieurs employés
* Un employé appartient à un département
* Un employé possède plusieurs congés
* Un employé possède plusieurs contrats

---

## Base de données

### Table employes

* id
* nom
* prenom
* email
* telephone
* poste
* departement_id
* date_embauche
* salaire
* solde_conges

### Table departements

* id
* nom

### Table conges

* id
* employe_id
* type
* date_debut
* date_fin
* motif
* statut

### Table contrats

* id
* employe_id
* type
* date_debut
* date_fin
* salaire
* statut

---

## Technologies utilisées

* Laravel 12
* PHP 8+
* MySQL
* Eloquent ORM
* Blade
* HTML5
* CSS3
* phpMyAdmin

---

## Installation

Cloner le projet :

```bash
git clone https://github.com/VOTRE-USERNAME/VOTRE-PROJET.git
```

Accéder au dossier :

```bash
cd laravel
```

Installer les dépendances :

```bash
composer install
```

Créer le fichier d'environnement :

```bash
cp .env.example .env
```

Générer la clé de l'application :

```bash
php artisan key:generate
```

Configurer la base de données dans le fichier `.env`.

Exécuter les migrations :

```bash
php artisan migrate
```

Lancer le serveur :

```bash
php artisan serve
```

---

## Auteur

**Sophie GOMIS**

Projet réalisé dans le cadre d'un système de Gestion des Ressources Humaines avec Laravel 12.

---

