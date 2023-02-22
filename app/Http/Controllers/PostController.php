<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;

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
}
