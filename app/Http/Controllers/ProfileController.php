<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    function recuperarPerfil($id){
        $follow = false;
        $nombreUsuario = User::find($id);
        $perfil = $nombreUsuario->profile;
        if ($id != Auth::user()->id) {
            if(Follow::where("user_id", Auth::user()->id)->where("user_follow_id", $id)->first()){
                $follow = true;
            }
        }
        $postsUsuario = $nombreUsuario->post;
        return view("perfil", compact("nombreUsuario", "perfil", "follow", "postsUsuario"));
    }

    function postsPerfil($id){
        $nombreUsuario = User::find($id);
        return $nombreUsuario->post;
    }

    function likesPerfil($id){
        $likesPerfil = Like::where("user_id", $id)->get();
        $postLikes = [];
        foreach ($likesPerfil as $like) {
            $postLikes[] = Post::find($like->post_id);
        }
        return $postLikes;
    }

    function siguiendoPerfil($id){
        $siguiendoPerfil = Follow::where("user_id", $id)->get();
        $perfiles = [];
        foreach ($siguiendoPerfil as $sig) {
            $profile = User::find($sig->user_follow_id)->profile;
            $profile["name"] = User::find($sig->user_follow_id)->name;
            $perfiles[] = $profile;
        }
        return $perfiles;
    }

    function darFollow($id){
        $seguirFollow = new Follow();
        $seguirFollow->user_id = Auth::user()->id;
        $seguirFollow->user_follow_id = $id;
        $seguirFollow->save();
    }

    function quitarFollow($id){
        Follow::where("user_id", Auth::user()->id)->where("user_follow_id", $id)->delete();
    }

}
