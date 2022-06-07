<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PeticionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'enabled'], function () {
    
    Route::put('usuarios/edit/{id}', [UserController::class, "update"])->name("usuarios.edit");
    Route::post('usuarios/edit/profileimg/{id}', [UserController::class, "updateProfileImg"])->name("usuarios.edit.profileimg.update");
    Route::get('usuarios/edit/{id}', [UserController::class, "edit"])->name("usuarios.edit");
    Route::delete('image/remove/{image}', [ImageController::class, "destroy"])->name("image.delete");
    Route::delete('mensajes/delete/all', [MessageController::class, "destroyAll"])->name("messages.delete.all");
    Route::delete('mensajes/delete/{id}', [MessageController::class, "destroy"])->name("messages.delete");
    Route::post('reports/add', [ReportController::class, "store"])->name("reports.add");
    Route::post('mensajes/add', [MessageController::class, "store"])->name("messages.add");
    Route::get('mensajes/{user}', [MessageController::class, "show"])->name("messages");
    Route::get('galeria/{name}', [UserController::class, "show"])->name("gallery");
    Route::get('galeria/')->name("gallery.route");
    Route::get('/', [HomeController::class, 'indexLogin'])->name('index.login');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/help', [HomeController::class, 'ayuda'])->name('help');
    Route::get('/getVotos', [VoteController::class, 'getAll'])->name('get.votos');

    Route::get("/usuarios", [UserController::class, 'getAll']);

    Route::resource("/imagenes", ImageController::class);
    Route::resource("/votos", VoteController::class);

});

Route::group(['middleware' => 'admin'], function () {
    Route::get("/users", [UserController::class, 'users'])->name('usersAdmin');
});

Auth::routes();

Route::get('/petition', [PeticionController::class, 'index'])->name('petition');
Route::resource("/peticiones", PeticionController::class);

