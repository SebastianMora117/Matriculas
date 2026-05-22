<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\GestionArchivosController;
use App\Http\Controllers\GestionUsuariosController;

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::resource('matriculas', MatriculasController::class)->middleware('auth');

Route::resource('gestionUsuarios', GestionUsuariosController::class)->middleware('auth');



/// Rutas para gestión de archivos
Route::resource('gestionArchivos', GestionArchivosController::class)->middleware('auth');

Route::get('/gestionArchivos/{id}/ver',       [GestionArchivosController::class, 'ver'])->name('gestionArchivos.ver')->middleware('auth');
Route::get('/gestionArchivos/{id}/descargar', [GestionArchivosController::class, 'descargar'])->name('gestionArchivos.descargar')->middleware('auth');
 
// Rutas gestion de usuarios
Route::middleware(['auth'])->group(function () {
 
    Route::get('/users',              [GestionUsuariosController::class, 'index'])   ->name('users.index');
    Route::post('/users',             [GestionUsuariosController::class, 'store'])   ->name('users.store');
    Route::get('/users/{user}/edit',  [GestionUsuariosController::class, 'edit'])    ->name('users.edit');
    Route::put('/users/{user}',       [GestionUsuariosController::class, 'update'])  ->name('users.update');
    Route::delete('/users/{user}',    [GestionUsuariosController::class, 'destroy']) ->name('users.destroy');
 
});
 