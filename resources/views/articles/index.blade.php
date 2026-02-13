@extends('layout')

@section('title','Articles')
@section('content')
<h2>Liste des articles</h2>

@if(session('success'))
  <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('articles.create') }}">+ Ajouter</a>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
  <tr>
    <th>ID</th><th>Titre</th><th>Auteur</th><th>Date</th><th>Actions</th>
  </tr>
  @foreach($articles as $a)
  <tr>
    <td>{{ $a->id }}</td>
    <td>{{ $a->title }}</td>
    <td>{{ $a->user->name }}</td>
    <td>{{ $a->created_at->format('Y-m-d') }}</td>
    <td>
      <a href="{{ route('articles.show',$a) }}">Voir</a> |
      <a href="{{ route('articles.edit',$a) }}">Modifier</a> |

      <form action="{{ route('articles.destroy',$a) }}" method="POST" style="display:inline"
            onsubmit="return confirm('Supprimer cet article ?')">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

<div style="margin-top:15px;">
  {{ $articles->links() }}
</div>
@endsection
