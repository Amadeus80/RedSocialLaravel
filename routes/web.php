<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\models\Follow;
use App\models\User;
use Illuminate\Support\Facades\Auth;

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
Route::get("inicio", function(){
    $user_follow = Follow::where("user_id", Auth::user()->id)->get();

    $posts = Auth::user()->post;

    foreach ($user_follow as $user){
        foreach (User::find($user->user_follow_id)->post as $post){
                $posts[] = $post;
        }
    }
    
    $posts = $posts->sortByDesc("created_at");
    return view("inicio", compact("posts"));
})->name("inicio")->middleware("auth");
/* Route::view("inicio", "inicio")->name("inicio")->middleware("auth"); */
Route::view("perfil", "perfil")->name("perfil")->middleware("auth");


Route::controller(AuthController::class)->group(function(){
    Route::post("login", "login")->name("login.log")->middleware("guest");
    Route::post("register", "register")->name("register.log")->middleware("guest");
    Route::post("logout", "logout")->name("logout")->middleware("auth");
});
