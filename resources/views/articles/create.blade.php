@extends('layout')
@section('title','Créer')
@section('content')
<h2>Créer un article</h2>

@if ($errors->any())
<div style="color:red">
  <ul>
    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
  </ul>
</div>
@endif

<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
  @csrf

  <label>Titre</label><br>
  <input name="title" value="{{ old('title') }}"><br><br>

  <label>Contenu</label><br>
  <textarea name="content" rows="6">{{ old('content') }}</textarea><br><br>

  <label>Image (optionnelle)</label><br>
  <input type="file" name="image" accept="image/*"><br><br>

  <button type="submit">Enregistrer</button>
</form>
@endsection
