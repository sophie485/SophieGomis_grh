<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

# GRH (Gestion des Ressources Humaines)

## 📌 Description
Application de gestion des ressources humaines développée avec Laravel 12.  
Elle permet de centraliser et gérer les employés d’une entreprise.

## 🚀 Fonctionnalités

### 👨‍💼 Gestion des employés
- Ajouter un employé
- Modifier un employé
- Supprimer un employé
- Lister les employés

### 📋 Informations employé
Chaque employé contient :
- Nom
- Prénom
- Email
- Téléphone
- Poste
- Département
- Date d’embauche
- Salaire

### 🏢 Départements
- Informatique
- Comptabilité
- Ressources Humaines
- Marketing

### 📷 Gestion des fichiers
- Photo de profil
- Documents (contrat, diplômes, etc.)

## 🛠️ Technologies
- Laravel 12
- PHP 8
- MySQL
- HTML / CSS
- phpMyAdmin

### 📅 Gestion des congés
- Création d’une demande de congé
- Validation / refus des congés
- Calcul automatique des jours de congé
- Déduction automatique du solde de congés
- Suivi du statut :
  - En attente
  - Approuvé
  - Refusé

---

### 🚫 Gestion des absences
- Enregistrement des absences des employés
- Types d’absences :
  - Maladie
  - Absence
  - Retard
- Historique des absences
- Lien avec les employés

---

## 🧠 Logique métier

- Chaque employé possède un **solde de congés**
- Lorsqu’un congé est **approuvé**, le système :
  - Calcule les jours (`date_fin - date_debut + 1`)
  - Déduit automatiquement du solde de congés
- Les absences sont enregistrées indépendamment des congés

---

## 🛠️ Technologies utilisées

- Laravel 12
- PHP 8+
- MySQL
- Blade (views)
- Eloquent ORM

---

## 🗂️ Structure du module

- `Employe` → gestion des employés et solde de congés
- `Conge` → gestion des demandes de congés
- `Absence` → gestion des absences
- `CongeController` → validation et calcul du solde
- `AbsenceController` → enregistrement des absences

---


## Technologies utilisées

* Laravel 12
* PHP 8
* MySQL
* HTML / CSS
* phpMyAdmin
