<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    function timeline(){
        $user_follow = Follow::where("user_id", Auth::user()->id)->get();

        $posts = Auth::user()->post;

        foreach ($user_follow as $user){
            foreach (User::find($user->user_follow_id)->post as $post){
                $posts[] = $post;
            }
        }

        $posts = $posts->sortByDesc("created_at");
        return view("inicio", compact("posts"));
    }

    function mostrarPost($id){
        $post = Post::find($id);

        return view("post", compact("post"));
    }
}
