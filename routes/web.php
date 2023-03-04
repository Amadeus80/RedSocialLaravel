<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::view("/", "portada")->name("portada");
Route::view("login", "login")->name("login")->middleware("guest");
Route::view("register", "register")->name("register")->middleware("guest");
Route::view("perfil", "perfil")->name("perfil")->middleware("auth");

Route::controller(PostController::class)->group(function(){
    Route::get("inicio", "timeline")->name("inicio")->middleware("auth");
    Route::get("post/{id}", "mostrarPost")->name("post")->middleware("auth");
    Route::post("realizarComentario", "realizarComentario")->name("comentario")->middleware("auth");
    Route::delete("borrarComentario", "borrarComentario")->name("borrarComentario")->middleware("auth");
    Route::post("publicarPost", "publicarPost")->name("publicarPost")->middleware("auth");
    Route::get("darLike/{id}", "darLike")->name("darLike")->middleware("auth");
    Route::get("quitarLike/{id}", "quitarLike")->name("quitarLike")->middleware("auth");
});

Route::controller(UserController::class)->group(function(){
    Route::get("user/{nombre}", "usersByWord")->name("users")->middleware("auth");
});


Route::controller(AuthController::class)->group(function(){
    Route::post("login", "login")->name("login.log")->middleware("guest");
    Route::post("register", "register")->name("register.log")->middleware("guest");
    Route::post("logout", "logout")->name("logout")->middleware("auth");
});
