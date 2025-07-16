<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


// Home
Route::get('/', [VoyageController::class, 'index'])->name('home');


//Routes Voyage (CRUD)
//Create voyage 
Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
// Par contre, pour soumettre le formulaire et créer le voyage, il y a restriction
Route::post('/voyages', [VoyageController::class, 'store'])->middleware('auth')->name('voyages.store');

//Affichage de voyage (uuid)
Route::get('/voyages/{id_voyage}', [VoyageController::class, 'show'])->name('voyages.show');


// Liste des voyages (index) il n'y a pas encore vue. C'est pour l'admin
Route::get('admin/voyages', [VoyageController::class, 'index'])->name('voyages.index');

//Edit voyage 
Route::get('voyage/{id_voyage}/edit', [VoyageController::class, 'edit'])->middleware('auth')->name('voyages.edit'); 
//Update - Soummision de la mise à jour 
Route::put('voyages/{id_voyage}', [VoyageController::class, 'update'])->middleware('auth')->name('voyages.update');

//Delete 
Route::delete('voyages/{id_voyage}', [VoyageController::class, 'delete'])->middleware('auth')->name('voyages.destroy'); 

//Visibilite voyage (public-prive) 
// PATCH : méthode HTTP appropriée pour une mise à jour partielle.

Route::patch('/voyages/{id_voyage}/toggle-visibilite', [VoyageController::class, 'toggleVisibilite'])
    ->middleware('auth')
    ->name('voyages.toggleVisibilite');



//Gestion Admin et user: 
// Routes User Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth:web')
    ->name('profile.show');


Route::middleware('auth:web')->group(function () {
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/profile/password', [UserController::class, 'editPassword'])->name('user.password.edit');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.password.update');
});


// Routes Admin Auth
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

//Dash admin 
 Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});
