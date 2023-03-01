<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

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
        $like = count(Like::where("post_id", $id)->get());

        return view("post", compact("post", "like"));
    }

    function realizarComentario(Request $request){
        $comentario = new Comment();
        $comentario->content = $request->comentario;  
        $comentario->user_id = $request->user_id;  
        $comentario->post_id = $request->post_id;  
        $comentario->save();
        return to_route('post', ['id' => $request->post_id])->with("mensaje", "Comentario insertado correctamente");
    }

    function borrarComentario(Request $request){
        $comentario = Comment::find($request->comment_id);
        $comentario->delete();
        return to_route('post', ['id' => $request->post_id])->with("mensajeBorrado", "Comentario borrado correctamente");
    }

}
