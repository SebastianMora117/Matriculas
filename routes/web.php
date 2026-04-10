<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MatriculasController;

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::resource('matriculas', MatriculasController::class)->middleware('auth');