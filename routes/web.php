<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\GestionUsuariosController;
use App\Http\Controllers\GestionArchivosController;

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

Route::get('/gestionArchivos',              [GestionArchivosController::class, 'index'])    ->name('gestionArchivos.index');
Route::post('/gestionArchivos',             [GestionArchivosController::class, 'store'])    ->name('gestionArchivos.store');
Route::get('/gestionArchivos/{id}/ver',     [GestionArchivosController::class, 'ver'])      ->name('gestionArchivos.ver');
Route::get('/gestionArchivos/{id}/descargar', [GestionArchivosController::class, 'descargar'])->name('gestionArchivos.descargar');
Route::delete('/gestionArchivos/{id}',      [GestionArchivosController::class, 'destroy'])  ->name('gestionArchivos.destroy');
 