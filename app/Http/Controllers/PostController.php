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
    /* TimeLine con los post */
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

    /* Mostrar los post */
    function mostrarPost($id){
        $post = Post::find($id);
        $like = count(Like::where("post_id", $id)->get());

        $postLike = Like::where("post_id", $id)->where("user_id", Auth::user()->id)->first();

        return view("post", compact("post", "like", "postLike"));
    }

    /* Hacer comentarios */
    function realizarComentario(Request $request){
        $comentario = new Comment();
        $comentario->content = $request->comentario;  
        $comentario->user_id = $request->user_id;  
        $comentario->post_id = $request->post_id;  
        $comentario->save();
        return to_route('post', ['id' => $request->post_id])->with("mensaje", "Comentario insertado correctamente");
    }

    /* Borrar comentarios */
    function borrarComentario(Request $request){
        $comentario = Comment::find($request->comment_id);
        $comentario->delete();
        return to_route('post', ['id' => $request->post_id])->with("mensajeBorrado", "Comentario borrado correctamente");
    }

    /* Publicación de Posts */
    function publicarPost(Request $request){
        $request->validate([
            'file' => 'image|max:5120',
        ]);

        $post = new Post();
        $post->titulo = $request->titulo;

        $ruta = public_path("img/posts/");
        $imagen = $request->file('file');
        $nombreImagen = $imagen->hashName();
        $imagen->move($ruta, $nombreImagen);
        $post->img = "img/posts/".$nombreImagen;

        $post->user_id = Auth::user()->id;
        $post->save();
        return back()->with("postPublicado", "El post se ha publicado correctamente");
    }

    /* Borrar Posts */
    function borrarPost(Request $request){
        $post = Post::find($request->id);
        $post->delete();
        return redirect('inicio')->with("postBorrado", "Post borrado");
    }

    /* Dar like a un post */
    function darLike($id){
        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->post_id = $id;
        $like->save();
    }

    /* Quitar like a un post */
    function quitarLike($id){
        Like::where("post_id", $id)->where("user_id", Auth::user()->id)->delete();
    }

}
