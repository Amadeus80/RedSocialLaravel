<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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
});


Route::controller(AuthController::class)->group(function(){
    Route::post("login", "login")->name("login.log")->middleware("guest");
    Route::post("register", "register")->name("register.log")->middleware("guest");
    Route::post("logout", "logout")->name("logout")->middleware("auth");
});
