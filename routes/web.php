<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProgrammeController;
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

Route::get('/programme/data', [ProgrammeController::class, 'findAll'])->name('programme.data');

Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

Route::delete('/demandes/{demande}', [DemandeController::class, 'destroy'])->name('demandes.destroy');


require __DIR__ . '/auth.php';
