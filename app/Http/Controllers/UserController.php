<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function usersByWord($nombre){
        $usuarios = User::where("name", "like", "%$nombre%")->get();
        $listado = [];
        foreach ($usuarios as $usuario) {
            $usuario->profile["name"] = $usuario->name;
            $listado[] = $usuario->profile;
        }
        return $listado;
    }
}
