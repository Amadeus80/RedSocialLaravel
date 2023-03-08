<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /* Busqueda de usuario por palabras */
    function usersByWord($nombre){
        $usuarios = User::where("name", "like", "%$nombre%")->get();
        $listado = [];
        foreach ($usuarios as $usuario) {
            $follow = false;
            if(Follow::where("user_id", Auth::user()->id)->where("user_follow_id", $usuario->id)->first()){
                $follow = true;
            }
            $usuario->profile["name"] = $usuario->name;
            $usuario->profile["follow"] = $follow;
            $listado[] = $usuario->profile;
        }
        return $listado;
    }
}
