<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

// Routes publiques
Route::middleware('guest')->group(function () {
    // Inscription
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Connexion
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Réinitialisation du mot de passe
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Routes protégées (nécessitent une authentification)
Route::middleware('auth')->group(function () {
    // Vérification d'email
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Confirmation du mot de passe
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route élèves
Route::resource('eleves', EleveController::class);

// Route pour afficher tous les élèves
Route::get('/eleves', [EleveController::class, 'index'])->name('eleves.index');

// Route pour afficher le formulaire de création d'un nouvel élève
Route::get('/eleves/create', [EleveController::class, 'create'])->name('eleves.create');

// Route pour enregistrer un nouvel élève
Route::post('/eleves', [EleveController::class, 'store'])->name('eleves.store');

// Route pour afficher les détails d'un élève spécifique
Route::get('/eleves/{id}', [EleveController::class, 'show'])->name('eleves.show');

// Route pour afficher le formulaire de modification d'un élève
Route::get('/eleves/{id}/edit', [EleveController::class, 'edit'])->name('eleves.edit');

// Route pour mettre à jour un élève
Route::put('/eleves/{eleve}', [EleveController::class, 'update'])->name('eleves.update');

// Route pour supprimer un élève
Route::delete('/eleves/{id}', [EleveController::class, 'destroy'])->name('eleves.destroy');





// Route pour les employers
Route::resource('employes', EmployeController::class);

Route::prefix('employes')->group(function () {
    Route::get('/', [EmployeController::class, 'index'])->name('employes.index'); // Afficher la liste des employés
    Route::get('/create', [EmployeController::class, 'create'])->name('employes.create'); // Afficher le formulaire de création
    Route::post('/', [EmployeController::class, 'store'])->name('employes.store'); // Enregistrer un nouvel employé
    Route::get('/{id}', [EmployeController::class, 'show'])->name('employes.show'); // Afficher les détails d'un employé
    Route::get('/{id}/edit', [EmployeController::class, 'edit'])->name('employes.edit'); // Afficher le formulaire d'édition
    Route::put('/{id}', [EmployeController::class, 'update'])->name('employes.update'); // Mettre à jour un employé
    Route::delete('/{id}', [EmployeController::class, 'destroy'])->name('employes.destroy'); // Supprimer un employé
});



Route::middleware(['auth'])->group(function () {
    Route::get('/presences', [PresenceEleveController::class, 'index'])->name('presences.index');
    Route::post('/presences', [PresenceEleveController::class, 'store'])->name('presences.store');
    Route::get('/presences/rapport', [PresenceEleveController::class, 'rapport'])->name('presences.rapport');
    Route::get('/presences/filter', [PresenceEleveController::class, 'filter'])->name('presences.filter');
});



Route::resource('resultats', ResultatController::class);


// Route vers la page d'accueil de la comptabilité
Route::get('/comptabilite', [ComptabiliteController::class, 'index'])->name('comptabilite.index');

// Routes pour les paiements
Route::get('/comptabilite/paiements/create', [PaiementController::class, 'create'])->name('comptabilite.paiements.create');
Route::post('/comptabilite/paiements', [PaiementController::class, 'store'])->name('comptabilite.paiements.store');

// Routes pour les factures
Route::get('/comptabilite/factures/create', [FactureController::class, 'create'])->name('comptabilite.factures.create');
Route::post('/comptabilite/factures', [FactureController::class, 'store'])->name('comptabilite.factures.store');


// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
