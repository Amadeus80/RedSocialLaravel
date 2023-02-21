<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
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

/* Route::get('/', function () {
    return view('inicio');
})->name("inicio"); */

Route::view("/", "login")->name("login")->middleware("guest");
Route::view("register", "register")->name("register")->middleware("guest");

Route::view("inicio", "inicio")->name("inicio")->middleware("guest");



Route::post("login", [AuthController::class, "login"])->name("login.log")->middleware("auth");
Route::post("register", [AuthController::class, "register"])->name("register.log")->middleware("auth");

Route::post("logout", [AuthController::class, "logout"])->name("logout")->middleware("auth");
