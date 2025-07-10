<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


// Affichage des voyages
Route::get('/', [VoyageController::class, 'index'])->name('home');

Route::get('voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
Route::post('voyages', [VoyageController::class, 'store'])->name('voyages.store');


Route::get('/voyages/{id_voyage}', [VoyageController::class, 'show'])->name('voyages.show');



// Routes User Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// Routes Admin Auth
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');



    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

// Formulaire accessible à tous, sans authentification
Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');

// Par contre, pour soumettre le formulaire et créer le voyage, tu peux mettre une restriction
Route::post('/voyages', [VoyageController::class, 'store'])->middleware('auth')->name('voyages.store');


// Liste des voyages (index) - si besoin
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
