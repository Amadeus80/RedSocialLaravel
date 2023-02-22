@extends('layout.plantilla')

@section("title", "Inicio")

@section('content') 
{{$posts}} 
   {{--  @foreach ($posts as $post)
        <div>
            <h1>{{$post->titulo}}</h1>
            <img src="{{$post->img}}" alt="">
            <span class="">user: {{$post->user_id}}</span>
            <span class="">Fecha: {{$post->created_at}}</span>
        </div>
    @endforeach --}}
@endsection