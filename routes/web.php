<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ReserveController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes');

Route::get('/programme', [ProgrammeController::class, 'index'])->name('programme');

Route::post('/programme/import', [ProgrammeController::class, 'importExcel'])->name('programme.import');

Route::post('/programme/import_flights', [ProgrammeController::class, 'importExcel2'])->name('programme.flights');

Route::get('/programme/data', [ProgrammeController::class, 'findAll'])->name('programme.data');

Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

Route::get('/demandes/export', [DemandeController::class, 'export'])->name('demandes.export');

Route::delete('/demandes/{demande}', [DemandeController::class, 'destroy'])->name('demandes.destroy');

Route::get('/reserves', [ReserveController::class, 'index'])->name('reserves');

Route::get('/reserves/data', [ReserveController::class, 'findAll'])->name('reserves.data');

Route::post('/reserves', [ReserveController::class, 'import'])->name('reserves.import');

Route::get('/notes', [NoteController::class, 'index'])->name('notes');

Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

require __DIR__ . '/auth.php';
