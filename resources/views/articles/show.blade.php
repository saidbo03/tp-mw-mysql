@extends('layout')
@section('title','Détail')
@section('content')
<h2>{{ $article->title }}</h2>
<p><b>Auteur:</b> {{ $article->user->name }}</p>
<p>{{ $article->content }}</p>

@if($article->image_path)
  <img src="{{ asset('storage/'.$article->image_path) }}" width="300">
@endif

<p style="margin-top:15px;">
  <a href="{{ route('articles.index') }}">Retour</a>
</p>
@endsection
