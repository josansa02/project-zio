<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::put('usuarios/edit/{id}', [UserController::class, "update"])->name("usuarios.edit");
Route::put('usuarios/edit/profileimg/{id}', [UserController::class, "updateProfileImg"])->name("usuarios.edit.profileimg.update");
Route::get('usuarios/edit/{id}', [UserController::class, "edit"])->name("usuarios.edit");
//Route::post('image/add', [ImageController::class, "store"])->name("image.add");
//Route::delete('image/remove/{id}', [ImageController::class, "destroy"])->name("image.remove.delete");
Route::get('mensajes/{user}', [MessageController::class, "show"])->name("messages");
Route::get('galeria/{name}', [UserController::class, "show"])->name("gallery");
Route::get('/', [HomeController::class, 'indexLogin'])->name('index.login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/help', [HomeController::class, 'ayuda'])->name('help');

Route::resource("/imagenes", ImageController::class);