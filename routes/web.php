<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


Route::view("login", "login")->name("login")->middleware("guest");
Route::view("register", "register")->name("register")->middleware("guest");
Route::view("/", "inicio")->name("inicio")->middleware("auth");



Route::post("login", [AuthController::class, "login"])->name("login.log")->middleware("guest");
Route::post("register", [AuthController::class, "register"])->name("register.log")->middleware("guest");

Route::post("logout", [AuthController::class, "logout"])->name("logout")->middleware("auth");
