@extends('layout.plantilla')

@section("title", "Inicio")

@section('content') 
    @foreach ($posts as $post)
        <div>
            <h1>{{$post->titulo}}</h1>
            <img src="{{$post->img}}" alt="">
            <span class="">user: {{$post->user->name}}</span>
            <img src="{{$post->user->profile->img}}" alt="" width="50" height="50">
            <span class="">Fecha: {{$post->created_at}}</span>
        </div>
    @endforeach
@endsection