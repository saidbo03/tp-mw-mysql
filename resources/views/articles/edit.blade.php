@extends('layout')
@section('title','Modifier')
@section('content')
<h2>Modifier l’article</h2>

@if ($errors->any())
<div style="color:red">
  <ul>
    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
  </ul>
</div>
@endif

<form method="POST" action="{{ route('articles.update',$article) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <label>Titre</label><br>
  <input name="title" value="{{ old('title',$article->title) }}"><br><br>

  <label>Contenu</label><br>
  <textarea name="content" rows="6">{{ old('content',$article->content) }}</textarea><br><br>

  <label>Nouvelle image (optionnelle)</label><br>
  <input type="file" name="image" accept="image/*"><br><br>

  @if($article->image_path)
    <p>Image actuelle:</p>
    <img src="{{ asset('storage/'.$article->image_path) }}" width="220">
  @endif

  <button type="submit">Mettre à jour</button>
</form>
@endsection
