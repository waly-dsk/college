<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\CoefficientController;
use App\Http\Controllers\EmploisDuTempsController;
use App\Http\Controllers\InfosGeneralesController;
use App\Http\Controllers\ResultatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});



Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::resource('infos_generales', InfosGeneralesController::class);
    Route::resource('news', NewsController::class);
    Route::resource('users', UserController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('groupes', GroupeController::class);
    Route::resource('series', SerieController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('coefficients', CoefficientController::class);
    Route::resource('eleves', EleveController::class);
    Route::resource('enseignants', EnseignantController::class);
    Route::resource('emplois_du_temps', EmploisDuTempsController::class);
});

Route::middleware(['auth', 'enseignant'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('notes/index', [NoteController::class, 'index'])->name('notes.index');
    Route::post('notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::post('notes/add', [NoteController::class, 'add'])->name('notes.add');
    Route::post('notes/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::post('notes/update/{periodicite}/{eleve}/{matiere}/', [NoteController::class, 'update'])->name('notes.update');
    Route::get('mon_emplois_du_temps/{enseignant_name}', [EmploisDuTempsController::class, 'mon_emplois_du_temps'])->name('mon_emplois_du_temps');
});

Route::middleware('auth')->prefix('visiteur')->name('visiteur.')->group(function () {
    Route::get('eleves/index', [VisiteurController::class, 'eleves_index'])
        ->name('eleves.index');

    Route::get('eleves/show/{id}', [VisiteurController::class, 'eleves_show'])
        ->name('eleves.show');

    Route::get('eleves/all/{classe}/{serie}/{groupe}', [VisiteurController::class, 'eleves_all'])
        ->name('eleves.all');

    Route::get('emplois_du_temps/index', [VisiteurController::class, 'emplois_du_temps_index'])
        ->name('emplois_du_temps.index');

    Route::get('coefficients/index', [CoefficientController::class, 'index'])
        ->name('coefficients.index');

    Route::get('coefficients/show/{niveau}', [CoefficientController::class, 'show'])
        ->name('coefficients.show');

    Route::get('emplois_du_temps/show/{classe}/{serie}/{groupe}', [VisiteurController::class, 'emplois_du_temps_show'])
        ->name('emplois_du_temps.show');

    Route::get('notes/show_note_start', [NoteController::class, 'show_note_start'])->name('notes.show_note_start');
    Route::post('notes/show_note_post', [NoteController::class, 'show_note_post'])->name('notes.show_note_post');

    Route::get('resultats/index', [ResultatsController::class, 'index'])->name('resultats.index');
    Route::post('resultats/post', [ResultatsController::class, 'post'])->name('resultats.post');
    Route::get('resultats/show/{periode}/{eleve}/', [ResultatsController::class, 'show'])->name('resultats.show');
});
