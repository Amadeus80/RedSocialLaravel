<h1>Titulo -> {{$post->titulo}}</h1>
<h1><img src="{{asset($post->img)}}" alt="Imagen Post"></h1>
<h1>Id Usuario -> {{$post->user_id}}</h1>
<h1>Nº Comentarios -> {{count($post->comment)}}</h1>
<h1>Comentarios: 
    @if (count($post->comment)>0)
        @foreach ($post->comment as $comment)
            <h2><img src="{{asset($comment->user->profile->img)}}" alt="imagen Usuario" width="50px" height="50px"></h2>
            <h2>{{$comment->user->name}}</h2>
            <h2>{{$comment->created_at}}</h2>
            <p>{{$comment->content}}</p>
        @endforeach   
    @else
        <h1>No hay comentarios</h1>
    @endif
</h1>

